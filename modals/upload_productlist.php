<div class="modal" id="modal-upload-master">
<div class="modal-footer">
    <button class="btn-flat modal-close" style="color:red;font-size:30px;">&times;</button>
</div>
<div class="modal-content">

    <div class="row">
        <div class="col s12">

        <form action="../process/import_excel.php"  enctype="multipart/form-data" method="POST">
            <div class="file-field input-field">
                <div class="btn teal #00695c teal darken-3">
                    <span>File</span>
                    <input type="file" name="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
                <div class="input-field col s12">
                    <input type="submit" value="upload" class="#btn col s12 btn-large teal #00695c teal darken-3" style="border-radius:30px;" name="upload">
                </div>
            </div>
        </form>

        </div>
    </div>

    <div class="row divider"></div>
    <div class="row">
        <div class="col s12 center">
            <a href="../templates/product_list_template.csv" class="btn col s12 btn-large #546e7a blue-grey darken-2" style="border-radius:30px;" download>Download Template</a>
        </div>
    </div>
</div>
</div>