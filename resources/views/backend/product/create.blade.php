@extends('backend.includes.master')
@section('content')
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Add New Product</h3>

            </div>
            <!-- /.card-header -->
            <form action="{{url('/admin/product-store')}}" method="post" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>product name*</label>
                                <input type="text" name="name" value="" class="form-control"
                                    placeholder="Enter product name*" required>
    
                            </div>
    
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>product sku code*</label>
                                <input type="text" name="sku_code" value="" class="form-control"
                                    placeholder="Enter product sku code*" required>
    
                            </div>
    
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Catagory</label>
                                <select class="form-control select2" style="width: 100%;" name="cat_id">
                                    <option selected disabled>Select Category</option>
                                   @foreach ($categories as $category )
                                   <option value="{{$category->id}}">{{$category->name}}</option>
                                   @endforeach
    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sub Select Catagory</label>
                                <select class="form-control select2" style="width: 100%;" name="sub_cat_id">
                                    <option selected disabled>Select Subcategory</option>
                                  @foreach ($subCategories as $subcategory )
                                  <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>

                                  @endforeach    
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" id="color_fields">
                                <label>product color (optional)</label>
                                <input type="text" name="color[]" id="color" value="" class="form-control"
                                    placeholder="Enter color">
    
                            </div>

                            <button type="button" class="btn btn-primary" id="add_color">Add more</button> 
    
                        </div>

                        <div class="col-md-6">
                            <div class="form-group" id="size_fields">
                                <label>product size (optional)</label>
                                <input type="text" name="size[]" id="size" class="form-control"
                                    placeholder="Enter size">
    
                            </div>

                            <button type="button" class="btn btn-primary" id="add_size">Add more</button> 

    
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>product quantity*</label>
                                <input type="number" name="qty" value="" class="form-control"
                                    placeholder="Enter product quantity*" required>
    
                            </div>
    
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Buying Price*</label>
                                <input type="number" name="buying_price" value="" class="form-control"
                                    placeholder="Enter product buying price*" required>
    
                            </div>
    
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Regular Price*</label>
                                <input type="number" name="regular_price" value="" class="form-control"
                                    placeholder="Enter product regular price*" required>
    
                            </div>
    
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Discount Price*</label>
                                <input type="number" name="discount_price" value="" class="form-control"
                                    placeholder="Enter product discount price*" required>
    
                            </div>
    
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Product Type</label>
                                <select class="form-control select2" style="width: 100%;" name="product_type">
                                    <option selected="selected" value="hot">Hot Product</option>
                                    <option value="new">New Arrival</option>
                                    <option value="regular">Regular Product</option>
                                    <option value="discount">Discount Product</option>
    
    
    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Product Description</label>
                                <textarea id="summernote" name="product_description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Product Policy</label>
                                <textarea id="summernote2" name="product_policy"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Product Image</label>
                                <input type="file" accept="image\*" name="image" value="" class="form-control">
    
                            </div>
    
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Product Gallery Images</label>
                                <input type="file" accept="image\*" name=" galleryimage[]" multiple value="" class="form-control">
    
                            </div>
    
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                            
                                <input type="submit" value="update" class="form-control btn btn-info">
    
                            </div>


    
                    </div>
    
                </div>
            </form>

        </div>
    </div>
@endsection

@push('js')
    <!-- Page specific script -->
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', {
                'placeholder': 'dd/mm/yyyy'
            })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', {
                'placeholder': 'mm/dd/yyyy'
            })
            //Money Euro
            $('[data-mask]').inputmask()

            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'L'
            });

            //Date and time picker
            $('#reservationdatetime').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                }
            });

            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            })
            //Date range as a button
            $('#daterange-btn').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                            'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                        'MMMM D, YYYY'))
                }
            )

            //Timepicker
            $('#timepicker').datetimepicker({
                format: 'LT'
            })

            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            $('.my-colorpicker2').on('colorpickerChange', function(event) {
                $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            })

            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })

        })
        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function() {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })

        // DropzoneJS Demo Code Start
        Dropzone.autoDiscover = false

        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template")
        previewNode.id = ""
        var previewTemplate = previewNode.parentNode.innerHTML
        previewNode.parentNode.removeChild(previewNode)

        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
            url: "/target-url", // Set the url
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
        })

        myDropzone.on("addedfile", function(file) {
            // Hookup the start button
            file.previewElement.querySelector(".start").onclick = function() {
                myDropzone.enqueueFile(file)
            }
        })

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function(progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
        })

        myDropzone.on("sending", function(file) {
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1"
            // And disable the start button
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
        })

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function(progress) {
            document.querySelector("#total-progress").style.opacity = "0"
        })

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions .start").onclick = function() {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
        }
        document.querySelector("#actions .cancel").onclick = function() {
            myDropzone.removeAllFiles(true)
        }
        // DropzoneJS Demo Code End
    </script>
    <script>

        $(function () {
          // Summernote
          $('#summernote').summernote()
      
          // CodeMirror
          CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            mode: "htmlmixed",
            theme: "monokai"
          });
        })
      </script>
       <script>
        $(function () {
          // Summernote
          $('#summernote2').summernote()
      
          // CodeMirror
          CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            mode: "htmlmixed",
            theme: "monokai"
          });
        })
      </script>

      <script>
       $(document).ready(function(){
        $("#add_color").click(function(){
            $("#color_fields").append('<input type="text" name="color[]" id="color" value="" class="form-control"  placeholder="Enter color">')
        })
       })

      </script>

<script>
    $(document).ready(function(){
     $("#add_size").click(function(){
         $("#size_fields").append(' <input type="text" name="size[]" id="size" class="form-control"   placeholder="Enter size">')
     })
    })

   </script>


@endpush
