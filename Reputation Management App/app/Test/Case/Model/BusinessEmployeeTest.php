<?php
App::uses('BusinessEmployee', 'Model');

/**
 * BusinessEmployee Test Case
 *
 */
class BusinessEmployeeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.business_employee',
		'app.user',
		'app.agencysite_setting',
		'app.business_review',
		'app.customer',
		'app.user_history',
		'app.business',
		'app.business_category',
		'app.business_social_media',
		'app.email_template',
		'app.feedback_setting',
		'app.visibility'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BusinessEmployee = ClassRegistry::init('BusinessEmployee');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BusinessEmployee);

		parent::tearDown();
	}

}
