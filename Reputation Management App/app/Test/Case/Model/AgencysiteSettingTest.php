<?php
App::uses('AgencysiteSetting', 'Model');

/**
 * AgencysiteSetting Test Case
 *
 */
class AgencysiteSettingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.agencysite_setting',
		'app.user',
		'app.business_employee',
		'app.business_review',
		'app.customer',
		'app.user_history'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AgencysiteSetting = ClassRegistry::init('AgencysiteSetting');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AgencysiteSetting);

		parent::tearDown();
	}

}
