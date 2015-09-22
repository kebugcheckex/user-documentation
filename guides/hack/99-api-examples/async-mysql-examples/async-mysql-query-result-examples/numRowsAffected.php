<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\QueryResult\NumRowsA;

require __DIR__ .'/../connect.inc.php';

use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

async function connect(\AsyncMysqlConnectionPool $pool):
  Awaitable<\AsyncMysqlConnection> {
  return await $pool->connect(
    CI::$host,
    CI::$port,
    CI::$db,
    CI::$user,
    CI::$passwd
  );
}
async function simple_query(): Awaitable<int> {
  $pool = new \AsyncMysqlConnectionPool(array());
  $conn = await connect($pool);
  $id = rand(100, 60000); // userID is a SMALLINT
  $name = str_shuffle("ABCDEFGHIJ");
  $query = 'INSERT INTO test_table (userID, name) VALUES ('
         . $id . ', "' . $name . '")';
  try {
    $result = await $conn->query($query);
    // How many rows were affected? Should be 1.
    var_dump($result->numRowsAffected());
  } catch (\AsyncMysqlQueryException $ex) {
    var_dump(-1); // this could happen if we try to insert duplicate user id
    $conn->close();
    return 0;
  }
  $conn->close();
  return $result->numRows();
}

function run(): void {
  $r = \HH\Asio\join(simple_query());
  var_dump($r);
}

run();
