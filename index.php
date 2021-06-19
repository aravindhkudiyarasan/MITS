<?php
header("refresh: 5");
?>

<!DOCTYPE html>
<html lang="en" >
<head><meta charset="UTF-8"><title>Version</title>
    <link rel='stylesheet' href=' http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css '>
    <link rel='stylesheet' href=' http://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.0/bootstrap-table.min.css '>
    <link rel='stylesheet' href=' http://rawgit.com/vitalets/x-editable/master/dist/bootstrap3-editable/css/bootstrap-editable.css '>
       <style>
          .table .thead-light th {
           color: #ffffff;
           background-color: #0099ff;
           border-color: #792700;
          }
          .red {
             background-color: #FF0000;
            }
          .section {
            margin-top: 60px;
            }
           .error {
                color: white;
                background-color: red;
            }
       </style>
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="#">TECKIEWEB Reports</a>
      </div>
      <ul class="nav navbar-nav">
         <li><a href="http://teckieweb.com/reports/incident.html">TEST</a></li>
         <li><a href="http://teckieweb.com/scripts/oncall/oncall.html">DATA</a></li>
         <li><a href="http://teckieweb.com/reports/containerComp.html">Cont</a></li>
      </ul>
      </div>
      </nav>
      <div class="container-fluid section"><h1 style="font-size:35px;" align="center">Install</h1>
      <div id="toolbar"><select class="form-control"><option value="all">Export All</option></select></div>

         <table id="table" data-toggle="table" data-pagination="true" data-page-list="[ 10, 25, 50, 100, ALL]" data-page-size="25" data-search="true"  data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" class="table-responsive table-striped">

         <thead class="thead-light"><tr><th data-field="Application" data-filter-control="input" data-sortable="true">Applications</th>
            <th data-field="Component" data-filter-control="input" data-sortable="true">Component</th>
            <th data-field="LatestVersion" data-filter-control="input" data-sortable="true">Latest version</th>
            <th data-field="signoffstatus" data-filter-control="input" data-sortable="true">Signoff Status</th>
            <th data-field="Requester" data-filter-control="input" data-sortable="true">Requester</th>
          <tbody>
 

                   <?php
                    if (($csvfile = fopen("agent.csv", "r")) !== FALSE) {
                        while (($csvdata = fgetcsv($csvfile, 1000, ",")) !== FALSE) {
                            $error='';
                            $colcount = count($csvdata);
                            echo '<tr>';
                            if($colcount!=5) {
                                $error = 'Column count incorrect';
                            } else {
                                //check data types
                                //if(!is_numeric($csvdata[0])) $error.='error';
                                #$date = date_parse($csvdata[3]);
                                #if (!($date["error_count"] == 0 && checkdate($date["month"], $date["day"], $date["year"]))) $error.='error';
                                if(!is_numeric($csvdata[4])) $error.='error';
                            }
                            switch($error) {
                                case "Column count incorrect":
                                    echo '<td></td>';
                                    echo '<td></td>';
                                    echo '<td class="error" >'.$error.'</td>';
                                    echo '<td></td>';
                                    echo '<td></td>';
                                    break;
                                case "error":
                                    echo '<td class="error">'.$csvdata[0].'</td>';
                                    echo '<td class="error">'.$csvdata[1].'</td>';
                                    echo '<td class="error">'.$csvdata[2].'</td>';
                                    echo '<td class="error">'.$csvdata[3].'</td>';
                                    echo '<td class="error">'.$csvdata[4].'</td>';
                                    break;
                                default:
                                    echo '<td>'.$csvdata[0].'</td>';
                                    echo '<td>'.$csvdata[1].'</td>';
                                    echo '<td>'.$csvdata[2].'</td>';
                                    echo '<td>'.$csvdata[3].'</td>';
                                    echo '<td>'.$csvdata[4].'</td>';
                            }
                            echo '</tr>';
                        }
                        fclose($csvfile);
                    }
                ?>
            </tbody>
           </table>
    </div>
    <script src=' http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js '></script>
    <script src=' http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js '></script>
    <script src=' http://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.0/bootstrap-table.js '></script>
    <script src=' http://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/editable/bootstrap-table-editable.js '></script>
    <script src=' http://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/export/bootstrap-table-export.js '></script>
    <script src=' http://rawgit.com/hhurz/tableExport.jquery.plugin/master/tableExport.js '></script>
    <script src=' http://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/filter-control/bootstrap-table-filter-control.js '></script>
</body>
</html>
