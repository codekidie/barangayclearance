function initGeolocation()
{
  if( navigator.geolocation )
  {
     // Call getCurrentPosition with success and failure callbacks
     navigator.geolocation.getCurrentPosition( success, fail );
  }
  else
  {
     alert("Sorry, your browser does not support geolocation services.");
  }
}

function success(position)
{
         let user_id = $('#userid').val();

        $.ajax({
          url: base_url+"resident/profile/latlong/"+position.coords.latitude+"/"+position.coords.longitude+"/"+user_id,
        }).done(function(data) {
           console.log(data);
        });
}

function fail()
{
     // alert("Sorry, unaible to fetch current location.");
  
}
initGeolocation();


function profiles_pic()
{
      $.ajax({
        url: base_url+"resident/profiles",
      }).done(function(data) {
              $.each(data, function(k, v) {
                  if (v.profilepic === null) {

                  }else{
                     $('#prof'+k).attr('src', 'http://localhost/clearance/storage/app/'+v.profilepic);
                  }
              });
      });
}


function getPurokLeaders()
{
      $.ajax({
        url: base_url+"admin/purokleaders",
      }).done(function(data) {
         $('#purokleaders-wrapper').html(data);
          $('.purokleadersTable').dataTable();
      });
}

getPurokLeaders();
profiles_pic();