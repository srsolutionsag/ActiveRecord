<?php
chdir("../../../../../..");

require_once ("./Tests/Records/class.arUnitTestRecord.php");
require_once ("./Connector/class.arConnectorPdoDB.php");

class StackTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var pdoDB
     */
    protected $pdo;

    /**
     * @var string
     */
    protected $table_name;

    public function setUp()
    {
        PHPUnit_Framework_Error_Notice::$enabled = FALSE;
        arUnitTestRecord::installDB();
        $this->table_name = arUnitTestRecord::returnDbTableName();
        $this->pdo = arConnectorPdoDB::getConnector();
    }

    public function testTableExistant(){
        $this->assertTrue($this->pdo->tableExists(arUnitTestRecord::returnDbTableName()));
    }

    public function testCreation()
    {
        $entry = new arUnitTestRecord();
        $entry->setDescription("Description");
        $entry->setTitle("Title");
        $entry->setId(1);
        $entry->setUsrIds(array(1, 5, 9));
        $entry->create();

        $statement = $this->pdo->query("SELECT * FROM $this->table_name");
        $row = $this->pdo->fetchAssoc($statement);
        $statement->closeCursor();

        $this->assertTrue($row["id"] == 1);
        $this->assertTrue($row["title"] == "Title");
        $this->assertTrue($row["description"] == "Description");
        $this->assertTrue($row["usr_ids"] == "[1,5,9]");

        $entry = new arUnitTestRecord();
        $entry->setDescription("Fscription");
        $entry->setTitle("Title 2");
        $entry->setId(2);
        $entry->setUsrIds(array(10, 5, 3));
        $entry->create();

        $entry = new arUnitTestRecord();
        $entry->setDescription("Eescription");
        $entry->setTitle("Title 3");
        $entry->setId(3);
        $entry->setUsrIds(array(100, 2, 7));
        $entry->create();
    }

    public function testFind(){
        $entry = new arUnitTestRecord(1);
        $this->assertEquals($entry->getTitle(), "Title");

        $entry = new arUnitTestRecord(2);
        $this->assertEquals($entry->getTitle(), "Title 2");

        /** @var arUnitTestRecord $entry */
        $entry = arUnitTestRecord::find(3);
        $this->assertEquals($entry->getTitle(), "Title 3");

    }

    //TODO findOrGetInstance testen
    //TODO exception bei nicht vorhandener ID mit new ActiveRec.

    public function testWhere(){
        $entry = arUnitTestRecord::where(array("title" => "Title"));
        /** @var arUnitTestRecord $element */
        $element = $entry->first();
        $this->assertEquals($element->getId(), 1);

        //TODO some more where statements
    }

    public function testLimitAndOrder(){
        $list = arUnitTestRecord::limit(0, 2)->orderBy("description", "DESC");
        $array = $list->get();
        $first = array_shift($array);
        $second = array_shift($array);
        $this->assertTrue($first->getId() == 2);
        $this->assertTrue($second->getId() == 3);

        //TODO: meherer order by.

    }

    //TODO joins.

    //TODO mehr active records und list funktionen.

    public static function tearDownAfterClass(){
        $tableName = arUnitTestRecord::returnDbTableName();
        arConnectorPdoDB::getConnector()->manipulate("DROP TABLE {$tableName}");
    }
}
?>
