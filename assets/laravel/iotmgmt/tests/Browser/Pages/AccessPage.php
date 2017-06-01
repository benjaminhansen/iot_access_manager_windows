<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class AccessPage extends BasePage
{
    public $username;
    public $password;
    public $datafile;

    public function __construct()
    {
        $resource_path = __DIR__.'/../../../../../resources';
        $config_file = $resource_path.'/config.json';
        $config = json_decode(file_get_contents($config_file));

        $username = $config->auth->username;
        $password = $config->auth->password;

        $this->username = $username;
        $this->password = $password;
        $this->datafile = $resource_path.'/'.$config->device_file;
    }

    public function url()
    {
        return "https://access.ualr.edu/guest/auth_login.php?target=%2Fguest%2F";
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $fdata = [];
        $fh = fopen($this->datafile, "r");
        while(($data = fgetcsv($fh)) !== false) {
            $fdata[] = (object) [
                "mac" => $data[0],
                "name" => $data[1]
            ];
        }
        fclose($fh);

        $browser->visit($this->url())
                ->assertSee('Log in with your NetID')
                ->assertSee('Manage your personal device registrations.')
                ->type('username', $this->username)
                ->type('password', $this->password)
                ->click('#ID_form1a7842a5_auth_login_submit')
                ->assertSee('Add new device')
                ->clickLink('Add new device')
                ->assertSee('Add Device');

        foreach($fdata as $json) {
            $mac = $json->mac;
            $name = $json->name;

            $browser->assertSee('Add Device')
                    ->type('mac', $mac)
                    ->type('visitor_name', $name)
                    ->check('creator_accept_terms')
                    ->click('#ID_form2ca596b7_mac_create_submit')
                    ->assertSee('Successfully added new device')
                    ->clickLink('Add new device');
        }
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@element' => '#selector',
        ];
    }
}
