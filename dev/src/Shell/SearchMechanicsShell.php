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
class SearchMechanicsShell extends Shell
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
        $this->loadModel('Requests');
    }

    public function main()
    {
        $this->search();
    }

    function search()
	{
        $requests = $this->Requests->find('all')
                    ->contain([
                        'Payments',
                        'Mechanics' => [
                            'Schedules' =>[
                                'ScheduleLogs'
                            ]
                        ]
                    ])
                    ->where([
                        'Requests.mechanic_id IS NULL',
                        'Requests.status' => 7
                    ])
                    ->matching('Payments', function ($q) {
                        return $q->where([
                            'Payments.paid' => 1, 
                            'Payments.active' => 1
                        ]);
                    })
                    ->toArray();

        if(count($requests) > 0)
        {
            foreach($requests as $request)
            {
                $this->out('id: '.$request->id);
                $this->Users->searchMechanics($request->id);
            }
        }
    }
}