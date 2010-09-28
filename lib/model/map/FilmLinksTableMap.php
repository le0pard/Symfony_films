<?php


/**
 * This class defines the structure of the 'film_links' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Вто 28 Сен 2010 23:55:50
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class FilmLinksTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.FilmLinksTableMap';

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
		$this->setName('film_links');
		$this->setPhpName('FilmLinks');
		$this->setClassname('FilmLinks');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('film_links_id_seq');
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignPrimaryKey('FILM_ID', 'FilmId', 'INTEGER' , 'film', 'ID', true, null, null);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', true, 200, null);
		$this->addColumn('URL', 'Url', 'VARCHAR', true, 500, null);
		$this->addColumn('SORT', 'Sort', 'INTEGER', false, null, 0);
		$this->addColumn('HASH', 'Hash', 'VARCHAR', false, 10, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Film', 'Film', RelationMap::MANY_TO_ONE, array('film_id' => 'id', ), 'CASCADE', null);
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
			'symfony_timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
		);
	} // getBehaviors()

} // FilmLinksTableMap
