<?php
/**
 * BusinessEmployeeFixture
 *
 */
class BusinessEmployeeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index', 'comment' => 'UserId of User having role Employer  or MultiLocationManager '),
		'business_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'created_at' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'updated_at' => array('type' => 'timestamp', 'null' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'foreign_key_users' => array('column' => 'user_id', 'unique' => 0),
			'foreign_key_business' => array('column' => 'business_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'business_id' => 1,
			'created_at' => '2014-12-20 12:02:18',
			'updated_at' => 1419057138
		),
	);

}
