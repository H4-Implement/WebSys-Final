<?php

namespace App\Controllers;

use App\Models\LogModel;

class LogsController extends BaseController
{
    public function index()
    {
        $logModel = new LogModel();

        $currentPage = $this->request->getVar('page') ?? 1;

        // Paginate the logs with 10 entries per page
        $data = [
            'logs' => $logModel->paginate(10), 
            'pager' => $logModel->pager,       
            'title' => 'Logs and Reports'
        ];

        return view('include/header', $data)
            .view('include/navbar')
            . view('logs_view', $data)
            . view('include/footer');
    }
}

?>