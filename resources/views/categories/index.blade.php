@extends('layouts.master')

@section('header')

@endsection


@section('content')

<div class="row">
    <div class="col-sm-12">
        <ul id="categories">
        </ul>
    </div>
</div>


@endsection



@section('lastJS')
    <script>
        var previous = null;
        /*
         * This loads the default / root categories.
         */
        function getRootCategories() {
            $.getJSON("api/categories", function(data) {
                var categories = [];
                $("#categories").html("");
                $.each(data, function(key, val) {
                    $("#categories").append("<li data-parent='" + val.parent + "' data-id='" + val.id + "' onClick='getSubcats(this);'>" + val.name + '</li>');
                    previous = val.parent;
                });
            });
        }

        /*
         * This loads the sub categories if there's any data returned. Otherwise, just leave the user where they are.
         */
        function getSubcats(cat) {
            var dataID = cat.getAttribute("data-id");
            previous = cat.getAttribute("data-parent");

            if (dataID == "null" || dataID == null || dataID == '') {
                getRootCategories();
            }
            else {
                $.getJSON("api/categories/" + dataID, function (data) {
                    if (data.length != 0) {
                        $("#categories").html(""); // clear the previous categories out so we can replace them with the new categories
                        var newCats = '';
                        var parent = '';
                        $.each(data, function (key, val) {
                            parent = "<li data-id='" + previous + "' onClick='getSubcats(this);'>Back</li>";
                            newCats += "<li data-parent='" + val.parent + "' data-id='" + val.id + "' onClick='getSubcats(this);'>" + val.name + '</li>';
                        });
                        $("#categories").append(parent + newCats);

                    }
                })
                .fail(function(jqxhr, textStatus, error) {
                    console.log("Request Failed: " + textStatus + " - " + error);
                });
            }
        }

        $(document).ready(function() {
            $.ajaxSetup({ cache:false });
            getRootCategories();
        });
    </script>

@endsection
