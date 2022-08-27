
var myEditorMovimiento;
  
ClassicEditor
    .create(document.querySelector('#movimiento'),
        {

            language: 'es',
            /*
            toolbar:
            {
                items:
                    [
                        'heading', '|',
                        'fontfamily', 'fontsize', '|',
                        'alignment', '|',
                        'fontColor', 'fontBackgroundColor', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript', '|',
                        'link', '|',
                        'outdent', 'indent', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'code', 'codeBlock', '|',
                        'insertTable', '|',
                        'uploadImage', 'blockQuote', '|',
                        'undo', 'redo'
                    ],
                shouldNotGroupWhenFull: true
            },
            */
            //toolbar: [ 'bold', 'italic', 'link', 'undo', 'redo', 'numberedList', 'bulletedList' ],
            /*
            toolbar: {
                items: [ 'bold', 'italic', '|', 'undo', 'redo', '|', 'numberedList', 'bulletedList' ]
            },
            */
         
        }


    )
    .then(editor => {
        //console.log( 'Editor was initialized', editor );
        myEditorMovimiento = editor;
        //console.log(myEditor);

    })
    .catch(err => {
        console.error(err.stack);
    });





