/* -- Helpers  --*/
Handlebars.registerHelper('validate', function(lvalue, rvalue, options) {
    if (arguments.length < 3)
        throw new Error("Handlebars Helper equal needs 2 parameters");
    if( lvalue!=rvalue ) {
        return options.inverse(this);
    } else {
        return options.fn(this);
    }
});

/* -- Template JS -- */

// -- Grids -- //
function GridbeforeSend(){
  var source   = '<tr><td colspan="10"><center>{{ message }}</center><td></tr>';
  var template = Handlebars.compile(source);
  var html    = template({message: "Loading..."});
  $(".items").empty().append(html);
}

function GridSuccess(response){
  var source   = $("#response-template").html();
  var template = Handlebars.compile(source);
  var html     = template(response);
  $(".items").empty().append(html);
}

function GridError(response){
  var source   = '<tr><td colspan="9"><center>{{ message }}</center><td></tr>';
  var template = Handlebars.compile(source);
  var html    = template(response.responseJSON);
  $(".items").empty().append(html);
}
// -- Grids -- //
