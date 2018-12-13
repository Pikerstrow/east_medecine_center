$(document).ready(function(){


    /*Image uploader*/

    const UploadAdapter = class {
        constructor( loader ) {
            // Save Loader instance to update upload progress.
            this.loader = loader;
        }

        upload() {
            const self = this;
            const formData = new FormData();
            formData.append('image', this.loader.file);

            const request = $.ajax({
                type: 'POST',
                url: 'includes_admin/ajax_save_news_image.php',
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
            });

            return new Promise(resolve => {
                request.then(data =>
                    resolve(data)
                )
            });
        }

        abort() {
            // Reject promise returned from upload() method.
            // server.abortUpload();
        }
    }

    /*Image uploader*/


    $('#add_news_textarea').each(function(){
        ClassicEditor
            .create(this,{
                image: {
                    toolbar: [ 'imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:full', 'imageStyle:alignRight' ],
                    styles: [
                        // This option is equal to a situation where no style is applied.
                        'full',

                        // This represents an image aligned to the left.
                        'alignLeft',

                        // This represents an image aligned to the right.
                        'alignRight'
                    ]
                },
                alignment: {
                    toolbar: ['alignment:left', 'alignment:right', 'alignment:center', 'alignment:justify'],
                    options: [ 'left', 'right', 'center', 'justify' ]
                }
            })
            .then(editor => {
                editor.plugins.get('FileRepository').createUploadAdapter = (loader) => new UploadAdapter(loader)
            })
            .catch(error => console.error());
    });


});