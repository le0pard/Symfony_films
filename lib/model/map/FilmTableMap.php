<?php


/**
 * This class defines the structure of the 'film' table.
 *
 *
 * This class was autogenerated by Propel 1.4.0 on:
 *
 * Mon Nov 30 01:12:14 2009
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class FilmTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.FilmTableMap';

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
		$this->setName('film');
		$this->setPhpName('Film');
		$this->setClassname('Film');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'users', 'ID', true, null, null);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', true, 500, null);
		$this->addColumn('ORIGINAL_TITLE', 'OriginalTitle', 'VARCHAR', true, 500, null);
		$this->addColumn('NORMAL_LOGO', 'NormalLogo', 'VARCHAR', false, 255, null);
		$this->addColumn('THUMB_LOGO', 'ThumbLogo', 'VARCHAR', false, 255, null);
		$this->addColumn('URL', 'Url', 'VARCHAR', false, 500, null);
		$this->addColumn('PUB_YEAR', 'PubYear', 'INTEGER', false, null, null);
		$this->addColumn('DIRECTOR', 'Director', 'VARCHAR', false, 255, null);
		$this->addColumn('CAST', 'Cast', 'VARCHAR', false, 1000, null);
		$this->addColumn('ABOUT', 'About', 'LONGVARCHAR', false, null, null);
		$this->addColumn('COUNTRY', 'Country', 'VARCHAR', false, 500, null);
		$this->addColumn('DURATION', 'Duration', 'VARCHAR', false, 500, null);
		$this->addColumn('FILE_INFO', 'FileInfo', 'LONGVARCHAR', false, null, null);
		$this->addColumn('IS_VISIBLE', 'IsVisible', 'BOOLEAN', true, null, true);
		$this->addColumn('IS_PRIVATE', 'IsPrivate', 'BOOLEAN', true, null, false);
		$this->addColumn('IS_PUBLIC', 'IsPublic', 'BOOLEAN', true, null, false);
		$this->addColumn('UPDATE_DATA', 'UpdateData', 'TIMESTAMP', false, null, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Users', 'Users', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
    $this->addRelation('FilmLinks', 'FilmLinks', RelationMap::ONE_TO_MANY, array('id' => 'film_id', ), 'CASCADE', null);
    $this->addRelation('FilmRaiting', 'FilmRaiting', RelationMap::ONE_TO_MANY, array('id' => 'film_id', ), 'CASCADE', null);
    $this->addRelation('FilmGallery', 'FilmGallery', RelationMap::ONE_TO_MANY, array('id' => 'film_id', ), 'CASCADE', null);
    $this->addRelation('FilmFilmTypes', 'FilmFilmTypes', RelationMap::ONE_TO_MANY, array('id' => 'film_id', ), 'CASCADE', null);
    $this->addRelation('Comments', 'Comments', RelationMap::ONE_TO_MANY, array('id' => 'film_id', ), 'CASCADE', null);
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

} // FilmTableMap
