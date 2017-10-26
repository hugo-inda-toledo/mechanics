<?php
use Migrations\AbstractSeed;

/**
 * ReportsData seed.
 */
class ReportsDataSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
      // Datos para modelos de reportes de: salud, precompra y servicio
      $this->call('ReportQuestionCategoriesSeed');
      $this->call('ReportQuestionGroupsSeed');
      $this->call('ReportQuestionsSeed');
      $this->call('ReportQuestionAlternativesSeed');

    }
}
