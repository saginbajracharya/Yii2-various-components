<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'JSONEditor';
$this->params['breadcrumbs'][] = $this->title;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>JSON Editor</title>

    <!-- Favicon -->
    <link href="../images/ybase-favico.png" rel="icon" type="image/x-icon" />

    <!-- Foundation CSS framework (Bootstrap and jQueryUI also supported) -->
    <link rel='stylesheet' href='//cdn.jsdelivr.net/foundation/5.0.2/css/foundation.min.css'> 

    <!-- Font Awesome icons (Bootstrap, Foundation, and jQueryUI also supported) -->
    <link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'> 

    <!-- JSON Editor -->
    <script src="https://cdn.jsdelivr.net/npm/@json-editor/json-editor@latest/dist/jsoneditor.min.js"></script>

    <script type="text/javascript">
        // Set the default CSS theme and icon library globally
        JSONEditor.defaults.theme = 'foundation5';
        JSONEditor.defaults.iconlib = 'fontawesome4';
        function getJson(json) {
            try {
                var Json = JSON.parse(json);
            }catch (e) {
            }
            editor.setValue(Json);
        }   
        function setJson(json){
          console.log(json);
        }   
    </script>

</head>
<body>

    <div class='row' align="right">
        <div class='medium-12-columns'>
            <button id='restore' class='secondary tiny'>Reset</button>
            <button id='enable_disable' class='tiny'>Disable/Enable Form</button>
            <button id='submit' class='tiny'>Submit</button>
        </div>
    </div>

    <div class='row'>
        <div id='editor_holder' class='medium-12 columns'></div>
    </div>                                                                      
    <script>
        // This is the starting value for the editor
        // We will use this to seed the initial editor 
        // and to provide a "Restore to Default" button.
        var element   = document.getElementById('editor_holder'),
            indicator = document.getElementById('valid_indicator');
        //  starting_value = window.parent.Ext.ComponentQuery.query('window[itemId=jsoneditor]')[0].params;
          
        // Initialize the editor
        var editor = new JSONEditor(element,{
            "schema": {
              "title"   : " ",
              "id"      : "editor",
              "type"    : "object",
              "format"  : "normal",
              "options" : {
                "collapsed"         : false,
                "disable_edit_json" : false,
                "disable_properties": false,
              },
            }
        });

        // Hook up the submit button to log to the console
        document.getElementById('submit').addEventListener('click',function() {
            setJson(editor.getValue());            
        });
          
        // Hook up the Restore to Default button
        document.getElementById('restore').addEventListener('click',function() {
            editor.setValue(null);
        });

        // Hook up the enable/disable button
        document.getElementById('enable_disable').addEventListener('click',function() {
            if(!editor.isEnabled()) {
                editor.enable();
            }else {
                editor.disable();
            }
        });
        
    </script>
</body>
</html>
