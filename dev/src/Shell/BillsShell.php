<?php
namespace App\Shell;

use Cake\Console\ConsoleOptionParser;
use Cake\Console\Shell;
use Cake\Log\Log;
use Psy\Shell as PsyShell;
use App\Shell\TableRegistry;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\Cache\Cache;
use Cake\Routing\Router;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Mailer\Email;


/**
 * Simple console wrapper around Psy\Shell.
 */
class BillsShell extends Shell
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Requests');
    }

    public function main()
    {
        $this->pendingClientBills();
    }

    function pendingClientBills()
	{
        $file_url = Router::url(['controller' => 'Admin/Requests', 'action' => 'excelToBills', '_ext' => 'xlsx', '_full' => true]);
        $folder_url = Router::url(ROOT . DS . 'webroot' . DS . 'files/documentos/pago_clientes/excel');

        $this->out($file_url);
        $this->out($folder_url);

        $file_data = file_get_contents($file_url);

        $file = new File($folder_url.'/pending-bills-'.date('Y-m-d').'.xlsx', true, 0644);
        
        if($file->write($file_data))
        {
            $email = new Email('default');
            $email->From(['intranet.ideauno@gmail.com' => 'FullMec'])
                ->To('hugo.inda@gmail.com')
                ->Subject('Boletas y facturas '.date('d-m-Y'))
                ->Attachments([$folder_url.'/pending-bills-'.date('Y-m-d').'.xlsx'])
                ->send('Se adjunta listado de solicitudes sin boleta');

        }
	}
}