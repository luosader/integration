// $(document).ready(function(){
//     $('li em').hide();
// });

function preview(f,o)  
{
    var prevDiv = document.getElementById('preview'+o);
    if (f.files && f.files[0]) {
        var reader = new FileReader();
        reader.onload = function(evt) {
            prevDiv.innerHTML = '<img src="' + evt.target.result + '" />';
        }
        reader.readAsDataURL(f.files[0]);
    } else {
        // prevDiv.innerHTML = '<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + f.value + '\'"></div>';
        prevDiv.innerHTML = '<img style="max-width:215px;max-height:110px" src="'+ f.value +'" />';
    }
    // console.log(f.type)
    // console.log(f.name)
    // console.log(f.value)
    // console.log(f.files[0]['name'])
    // console.log(f.files[0]['size'])
    // console.log(f.files[0]['type'])
}




//  function preview1(file)  
//  {  
//  var prevDiv = document.getElementById('preview1');  
//  if (file.files && file.files[0])  
//  {  
//  var reader = new FileReader();  
//  reader.onload = function(evt){  
//  prevDiv.innerHTML = '<img src="' + evt.target.result + '" />';  
// }    
//  reader.readAsDataURL(file.files[0]);  
// }  
//  else    
//  {  
//  prevDiv.innerHTML = '<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>';  
//  }  
//  }