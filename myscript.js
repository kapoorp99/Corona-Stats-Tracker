function main()
{
  getLocation();
  auto_sub();
  removeElement();
}
  var la,lo;

  function removeElement()
  {
    document.getElementById("suid").style.display = "none";
  }

function getLocation() 
{
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}
function auto_sub()
{
 $(document).ready(function(){
  $("#suid").click(function(){
   $.ajax({
     type: 'post',
      data:{var_lat:la,var_lon:lo},
      dataType: 'json',
      success: function(response)
      {
        alert(response[0]+", "+response[1]+"\nActive: "+response[2]+"\nConfirmed: "+response[3]+"\nDied: "+response[4]+"\nRecovered: "+response[5]);
      },
      error: function(err)
      {
        alert("error\n make sure you are connected to internet\nAlso allow location access to this site for correct information.");
      }
   });
 return false;
 });
 });
}
function showPosition(position)
{
  document.getElementById("var_lat").value = position.coords.latitude;
  document.getElementById("var_lon").value = position.coords.longitude;
  la=position.coords.latitude;
  lo=position.coords.longitude;
  $( document ).ready(function() {
   $( "#suid" ).trigger( "click" );
});
}