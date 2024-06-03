<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
       body{
        font-family: Roboto,sans-serif!important;
        margin: 0;
        padding: 0;
       }
    </style>
</head>
<body style="background: #f3f3f3;  display: flex; justify-content: center; align-items: center; height: 100vh;  ">
<section>
    <table cellpadding="0" cellspacing="0" border="0" align="center" style="background: #fff;"   >
        <tr>
            <td style="max-width: 700px;">
                
                <table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
                    <tr>
                        <td style="padding: 10px; height: 60px;  background-color: #fff; text-align: center;  border-bottom: 1px solid #f4f4f4;">
                            Codigo Mantra
                        </td>
                    </tr>
                </table>
    
               
                <table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
                    <tr>
                        <td style="padding: 20px; ">
                            <h2 style="text-align: center; font-size: 26px; font-weight: 600; margin-top: 0; color: #134d75;">Hello!</h2>
                            <p> Link : <a href="{{$data['link_to_blog']}}">Click here</a></p>
                            <p> Hi {{$data['to']}}, please have a look at this blog. It's amazingly written by {{$data['written_by']}}</p>
                            <p> {{$data['comment']}}</p>
       
                        <p  > Thank You </p>
                        <p  > Team <b>Codigo Mantra</b> </p>
                        </td>
                    </tr>
                </table>
    
           
                <table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
                    <tr>
                        <td style="height: 40px;  text-align: center; background: #f6a21e; line-height: 2rem;">
                        
                           <span  style="font-size: 15px; ">© COPYRIGHT 2023 <i>CODIGO MANTRA</i> All Rights Reserved.</span> 
 
                        </td>
                      
                </table>
            </td>
        </tr>
    </table>
       
</section>
</body>
</html>
