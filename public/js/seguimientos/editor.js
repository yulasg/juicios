
var myEditor;
  
ClassicEditor
    .create(document.querySelector('#seguimiento'),
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
        myEditor = editor;
        //console.log(myEditor);

    })
    .catch(err => {
        console.error(err.stack);
    });





