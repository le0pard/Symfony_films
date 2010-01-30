<?php


/**
 * This class defines the structure of the 'afisha_time' table.
 *
 *
 * This class was autogenerated by Propel 1.4.0 on:
 *
 * Sat Jan 30 21:25:08 2010
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class AfishaTimeTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.AfishaTimeTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('afisha_time');
		$this->setPhpName('AfishaTime');
		$this->setClassname('AfishaTime');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('AFISHA_ID', 'AfishaId', 'INTEGER', 'afisha', 'ID', true, null, null);
		$this->addColumn('TIME', 'Time', 'VARCHAR', true, 200, null);
		$this->addColumn('PRICE', 'Price', 'VARCHAR', false, 100, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Afisha', 'Afisha', RelationMap::MANY_TO_ONE, array('afisha_id' => 'id', ), 'CASCADE', null);
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
		);
	} // getBehaviors()

} // AfishaTimeTableMap
