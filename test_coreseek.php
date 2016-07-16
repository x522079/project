<?php
//require_once( './sphinxapi.php' );
$coreseek = new SphinxClient();
$coreseek->SetServer( '115.28.173.37', 9312 );
$coreseek->SetArrayResult( true );
$coreseek->SetMatchMode( SPH_MATCH_ALL );
$coreseek->SetSortMode( SPH_SORT_RELEVANCE );
$search_result = $coreseek->Query( '梦', 'test1' );
//var_dump($search_result['matches']);die;
$matchedIds=$search_result['matches'];
if (!$matchedIds){
    exit('没有记录');
}
$dsn = 'mysql:dbname=db_cicimandy;host=115.28.173.37';
try {
    $pdo = new PDO( $dsn, 'stat', '' );
} catch ( Exception $e ) {
    echo $e->getMessage();
}

$sql='select * from t_sku_search LEFT JOIN t_spu ON t_sku_search.SpuId=t_spu.SpuId WHERE Id IN  ';
$id='(';
foreach ( $matchedIds as $value ) {
    $id.=$value['id'].',';
}
$ids=trim($id,',');
$sql.=$ids.')';
$query=$pdo->query($sql);
$result=$query->fetchAll(PDO::FETCH_ASSOC);
var_dump($result);


