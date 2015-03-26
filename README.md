# YiiCsvExport
Yii widget for simple csv export

##Installation

1. Copy "YiiCsvExport.php" to extensions dir (i.e. protected/extensions)

##Usage

$data = [
	'col1'=>"A",
	"col2"=>"B"
];
$this->widget('ext.CsvExport', array(
	'data'=>$data
));