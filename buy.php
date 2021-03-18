
     if(result['response'] == 'success'){
       showAlertDialog(context,"Successful","Thanks for your reques \n you will be credited shortly");
      // mySnack("Successful", Colors.blueAccent);
      //  Timer(Duration(seconds: 3),(){
        
      //  });
       
           setState(() {
        hasClicked =false;
      });

     }else if(result['response'] == 'insuficient_balance'){
        requestErro = "You don't have Enough balance please topup your account";
        showAlertDialog(context, "failed", "You do no have enough balance\n please topup you account balance");

     }
     else{
       print(response.body);
       showAlertDialog(context, "pp", "pp");
      //  setState(() {
      //    requestErro = "An Errro has occoured please try again later";
      //    showAlertDialog(context, "Error", "An erro has occoured please try again later");
      //      setState(() {
      //   hasClicked =false;
      // });
      //  });
     }
