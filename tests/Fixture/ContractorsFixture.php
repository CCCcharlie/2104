<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ContractorsFixture
 */
class ContractorsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'first_name' => 'Lorem ipsum dolor sit amet',
                'last_name' => 'Lorem ipsum dolor sit amet',
                'phone_number' => 'Lorem ip',
                'contractor_email' => 'Lorem ipsum dolor sit amet',
                'created' => '2024-10-14 04:13:42',
                'modified' => '2024-10-14 04:13:42',
            ],
        ];
        parent::init();
    }
}
