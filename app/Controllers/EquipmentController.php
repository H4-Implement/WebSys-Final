<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class EquipmentController extends BaseController {
    private $logModel;

    public function __construct() {
        // Load the LogModel
        $this->logModel = model('LogModel');
    }

    private function logAction($action, $itemId, $user) {
        // Create a log entry
        $this->logModel->insert([
            'action' => $action,
            'item_id' => $itemId,
            'user' => $user,
            'timestamp' => date('Y-m-d H:i:s') 
        ]);
    }

    public function index() {
        if (!session()->has('isLoggedIn')) {
            return redirect()->to('login');
        }
    
        // Load models
        $itemModel = model('Equipment_model');
        $search = $this->request->getGet('search');
    
        // Apply search conditions
        if ($search) {
            $itemModel->groupStart()
                        ->like('CATEGORY', $search)
                        ->orLike('NAME', $search)
                        ->orLike('STATUS', $search)
                        ->orLike('UNIQUEID', $search)
                        ->orLike('ID', $search)
                        ->groupEnd();
        }
    
        // Pagination and data retrieval
        $data['items'] = $itemModel->paginate(8);
        $data['pager'] = $itemModel->pager;
        $data['search'] = $search;
        $data['title'] = "Equipment Manager";

        $data['categoryCounts'] = $itemModel->select('ID, COUNT(*) as total')
                        ->where('STATUS', 'Available')
                        ->groupBy('ID')
                        ->findAll();
    
        return view('include/header', $data)
            . view('include/navbar')
            . view('equipments_view', $data)
            . view('include/footer');
    }
    

    public function add() {
        if ($this->request->is('POST')) {
            // Load model
            $itemmodel = model('Equipment_model');
    
            // Retrieve data from the form
            $itemdata = $this->request->getPost([
                'CATEGORY', 
                'NAME'
            ]);
    
            // Define category prefixes
            $prefixes = [
                'Extension'     => 'EXT',
                'VGA'           => 'VGA',
                'HDMI'          => 'HDMI',
                'Power'         => 'PWR',
                'Remote'        => 'RMT',
                'Peripherals'   => 'PRP',
                'Crimp'         => 'CRMP',
                'CableTester'   => 'CTT',
                'Keys'          => 'KEYS',
                'Laptop'        => 'LPTP',
                'Tablets'       => 'TBLT',
                'Speaker'       => 'SPKR',
                'Webcam'        => 'WBCM'
            ];
    
            // Validate category
            $category = $itemdata['CATEGORY'];
            $prefix = $prefixes[$category] ?? null;
    
            if (!$prefix) {
                return redirect()->back()->with('error', 'Invalid category selected.');
            }
    
            // Query the database for the highest UNIQUEID in the selected category
            $lastItem = $itemmodel->where('CATEGORY', $category)
                ->orderBy('UNIQUEID', 'DESC')
                ->first();
    
            // Determine the next counter value
            $lastCounter = 0;
            if ($lastItem && preg_match('/^' . preg_quote($prefix, '/') . '(\d{3})$/', $lastItem['UNIQUEID'], $matches)) {
                $lastCounter = (int)$matches[1];
            }
            $nextCounter = str_pad($lastCounter + 1, 3, '0', STR_PAD_LEFT);
    
            // Construct the UNIQUEID and ID
            $itemdata['ID'] = $prefix;
            $itemdata['UNIQUEID'] = $prefix . $nextCounter;
    
            // Handle image upload
            $imageFile = $this->request->getFile('IMAGE');
    
            if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
                // Validate file type (PNG only)
                if ($imageFile->getExtension() !== 'png') {
                    return redirect()->back()->with('error', 'Only PNG images are allowed.');
                }
    
                // Validate file size (for example, max size 2MB)
                if ($imageFile->getSize() > 2 * 1024 * 1024) { // 2MB limit
                    return redirect()->back()->with('error', 'Image size must not exceed 2MB.');
                }
    
                $newName = $itemdata['NAME'] . '.' . $imageFile->getExtension();
                $uploadPath = WRITEPATH . '../assets/img/';
    
                if ($imageFile->move($uploadPath, $newName)) {
                    $itemdata['IMAGE'] = $newName;
                } else {
                    return redirect()->back()->with('error', 'Failed to upload image. Please try again.');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid image file. Please try again.');
            }
    
            // Set default values
            $itemdata += [
                'STATUS' => 'Available',
            ];
    
            // Insert into the database
            if (!$itemmodel->insert($itemdata)) {
                $this->logAction('Add', $itemmodel->insertID(), 'admin');
                return redirect()->to('item')->with('success', 'Item successfully added.');
            } else {
                return redirect()->back()->with('error', 'Failed to add item. Please try again.');
            }
        }
    
        $data['title'] = "Add Item";
        return view('include/header', $data)
            . view('include/navbar')
            . view('equipments_add')
            . view('include/footer');
    }
    

    //EDIT BLOCK
    public function edit($UNIQUEID) {
        // Load the model
        $itemmodel = model('Equipment_model');
        
        // Check if the form is submitted
        if ($this->request->getMethod() === 'POST') {
            // Retrieve the form data
            $updatedata = $this->request->getPost(['NAME', 'IMAGE']);
            
            // Handle image upload if applicable
            $imageFile = $this->request->getFile('IMAGE');
            if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
                $newName = $updatedata['NAME'] . '.' . $imageFile->getExtension();
                $uploadPath = WRITEPATH . '../assets/img/';
                $fullPath = $uploadPath . $newName;

                // Check if a file with the same name already exists and delete it
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }

                if ($imageFile->move($uploadPath, $newName)) {
                    $updatedata['IMAGE'] = $newName; 
                } else {
                    return redirect()->back()->with('error', 'Failed to upload image. Please try again.');
                }
            }
    
            
            $isUpdated = $itemmodel->where('UNIQUEID', $UNIQUEID)->set($updatedata)->update();
    
            if ($isUpdated) {
                $this->logAction('Edit', $UNIQUEID, 'admin');
                return redirect()->to('item')->with('success', 'Item updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to update item. Please try again.');
            }
        }
    
        // Retrieve the current data for the item
        $data['item'] = $itemmodel->where('UNIQUEID', $UNIQUEID)->first();
        if (!$data['item']) {
            return redirect()->back()->with('error', 'Item not found.');
        }
    
        $data['title'] = "Edit Item";
        return view('include/header', $data)
            . view('include/navbar')
            . view('equipment_edit', $data)
            . view('include/footer');
    }

    //VIEW BLOCK
    public function view($UNIQUEID){
        // Load the model
        $itemmodel = model('Equipment_model');

        // Retrieve the data from the table
        $data['item'] = $itemmodel->where('UNIQUEID', $UNIQUEID)->first();
        // $this->dd($data['users']);

        $data['title'] = "View Item Information";

        return view('include\header', $data)
            .view('include\navbar')
            .view('equipment_singleview', $data)
            .view('include\footer');
    }

    public function deactivate($UNIQUEID) {
        $itemmodel = model('Equipment_model');
        $item = $itemmodel->where('UNIQUEID', $UNIQUEID)->first();
    
        if (!$item) {
            return redirect()->to('item')->with('error', 'Item not found.');
        }
    
        $isUpdated = $itemmodel->where('UNIQUEID', $UNIQUEID)->set(['STATUS' => 'Deactivated'])->update();
        if ($isUpdated) {
            return redirect()->to('item/edit/' . $UNIQUEID)->with('success', 'Item successfully deactivated.');
        } else {
            return redirect()->back()->with('error', 'Failed to deactivate item. Please try again.');
        }
    }

    public function activate($UNIQUEID) {
        $itemmodel = model('Equipment_model');
        $item = $itemmodel->where('UNIQUEID', $UNIQUEID)->first();
    
        if (!$item) {
            return redirect()->to('item')->with('error', 'Item not found.');
        }
    
        $isUpdated = $itemmodel->where('UNIQUEID', $UNIQUEID)->set(['STATUS' => 'Available'])->update();
        if ($isUpdated) {
            return redirect()->to('item/edit/' . $UNIQUEID)->with('success', 'Item successfully activated.');
        } else {
            return redirect()->back()->with('error', 'Failed to activate the item.');
        }
    }

    //DELETE BLOCK
    public function delete($UNIQUEID) {
        // Load the model
        $itemmodel = model('Equipment_model');
        
        // Attempt to delete the item
        $isDeleted = $itemmodel->delete($UNIQUEID);
        
        // Check if the deletion was successful
        if ($isDeleted) {
            $this->logAction('Delete', $UNIQUEID, 'admin');
            return redirect()->to('item')->with('success', 'Item successfully deleted.');
        } else {
            return redirect()->to('item')->with('error', 'Failed to delete item. Please try again.');
        }
    }
    
}