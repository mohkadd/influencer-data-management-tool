<form name="importyoutube" id="importyoutube" method="post" action="" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="form-row">

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="uploadfile">Upload Excel (<strong class="text-danger">**only .xlsx file to be uploaded</strong>)</label>
                          <input type="file" id="uploadfile" name="uploadfile" class="form-control" required="required" accept=".xlsx">
                          <span class="text-danger" id="exterror" style="display: none;"><strong>Please Enter Valid File</strong></span>
                          <span class="text-danger" id="msgerror" style="display: none;"><strong>Data Imported Successfully with Profile URL Validation</strong></span>
                          <span class="text-success" id="msgsuccess" style="display: none;"><strong>Data Imported Successfully</strong></span>

                        </div>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-danger" type="submit" name="submitfile" id="submitfile">Import</button>
                </form>
<?php 
include 'config-pdo.php';
if(isset($_POST['submitfile'])){

        $uploadog = $_FILES['uploadfile']['name'];
        $uploadfile=$_FILES['uploadfile']['tmp_name'];
        require 'PHPExcel1/Classes/PHPExcel.php';
        require_once 'PHPExcel1/Classes/PHPExcel/IOFactory.php';
        $error = 0;
        $impcount = 0;
        $objExcel=PHPExcel_IOFactory::load($uploadfile);
        foreach($objExcel->getWorksheetIterator() as $worksheet)
        {
            $highestrow=$worksheet->getHighestRow();

            for($row=0;$row<=$highestrow;$row++)
            {

                $name = $worksheet->getCellByColumnAndRow(0,$row)->getValue();
                $added_on = $worksheet->getCellByColumnAndRow(1,$row)->getValue();
                $added_by = $worksheet->getCellByColumnAndRow(2,$row)->getValue();
                $updated_on = $worksheet->getCellByColumnAndRow(3,$row)->getValue();
                $updated_by = $worksheet->getCellByColumnAndRow(4,$row)->getValue();
                    $insertqry="INSERT INTO `state`(`name`, `added_on`, `added_by`,`updated_on`,`updated_by`) VALUES 
                    (:name,:added_on,:added_by,:updated_on,:updated_by)";
                    $stmt = $con->prepare($insertqry);
                    $stmt->execute([
                    "name"=>$name,"added_on"=>$added_on,
                    "added_by"=>$added_by, "updated_on"=>$updated_on,
                    "updated_by"=>$updated_by
                    ]);

                    
            }
        }
    echo "Uploaded Successfully";
}
?>