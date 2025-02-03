$(function () {
    'use strict'
   
    //  sing-up validation
    $("#registration").on('click', function(event)
    {
        // event.preventDefault();
        var inputName = $('#inputName').val();
        var inputEmail = $('#inputEmail').val();
        var inputPhone = $('#inputPhone').val();
        var inputPassword = $('#inputPassword').val();
        var inputConfirmPassword = $('#inputConfirmPassword').val();

        if(inputName == ""){
            $('#inputName-Error').html('Name is required.');
            return false;
        }else{
            $('#inputName-Error').html('');
        }

        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(inputEmail == ""){
            $('#inputEmail-Error').html('Email is required.'); 
            return false;
        }
        else if (!emailPattern.test(inputEmail)) {
            $("#inputEmail-Error").text("Invalid email format.");
            return false;
        }
        else{
            $('#inputEmail-Error').html('');
        }


        if(inputPhone == ""){
            $('#inputPhone-Error').html('Phone is required.');
            return false;
        }else{
            $('#inputPhone-Error').html('');
        }

        if(inputPassword == ""){
            $('#inputPassword-Error').html('Password is required.');
            return false;
        }else{
            $('#inputPassword-Error').html('');
        }

        if(inputPassword.length < 6){
            $('#inputPassword-Error').html('Password must be at least 6 characters.');
            return false;
        }else{
            $('#inputPassword-Error').html('');
        }

        if(inputConfirmPassword == ""){
            $('#inputConfirmPassword-Error').html('Confirm password is required.');
            return false;
        }else{
            $('#inputConfirmPassword-Error').html('');
        }

        if(inputPassword != inputConfirmPassword){
            $('#inputConfirmPassword-Error').html('Password don\'t match.');
            return false;
        }else{
            $('#inputConfirmPassword-Error').html('');
        }
 
         
        $("#registrationForm").submit();
         
    });
    //  sing-in validation
    $("#singIn").on('click', function(event)
    {
       // event.preventDefault();
        var inputEmail = $('#inputEmail').val();
        var inputPassword = $('#inputPassword').val(); 

        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(inputEmail == ""){
            $('#inputEmail-Error').html('Email is required.'); 
            return false;
        }
        else if (!emailPattern.test(inputEmail)) {
            $("#inputEmail-Error").text("Invalid email format.");
            return false;
        }
        else{
            $('#inputEmail-Error').html('');
        }

        if(inputPassword == ""){
            $('#inputPassword-Error').html('Password is required.');
            return false;
        }else{
            $('#inputPassword-Error').html('');
        }

        $("#singInForm").submit(); 
    });
 
    //  create event validation
    $("#createEvent").on('click',function(event)
    {
        // event.preventDefault();
        var inputName = $('#inputName').val();
        var inputmaximumCapacity = $('#inputmaximumCapacity').val();
        var inputDescription = $('#inputDescription').val();
        var inputAddress = $('#inputAddress').val();
        var inputexpireDate = $('#inputexpireDate').val();
        
        if(inputName == ""){
            $('#inputName-Error').html('Name is required.');
            return false;
        }else{
            $('#inputName-Error').html('');
        }

        if(inputmaximumCapacity == ""){
            $('#inputmaximumCapacity-Error').html('Maximum capacity is required.');
            return false;
        }else{
            $('#inputmaximumCapacity-Error').html('');
        }

        if(inputDescription == ""){
            $('#inputDescription-Error').html('Description is required.');
            return false;
        }else{
            $('#inputDescription-Error').html('');
        }

        if(inputAddress == ""){
            $('#inputAddress-Error').html('Address is required.');
            return false;
        }else{
            $('#inputAddress-Error').html('');
        }

        if(inputexpireDate == ""){
            $('#inputexpireDate-Error').html('Expire date is required.');
            return false;
        }else{
            $('#inputexpireDate-Error').html('');
        }

        $("#createEventForm").submit();
    });

    //  create user validation
    $("#createUser").on('click', function()
    {
        // event.preventDefault();
        var inputName = $('#inputName').val();
        var inputEmail = $('#inputEmail').val();
        var inputPhone = $('#inputPhone').val();
        var inputPassword = $('#inputPassword').val();
        var inputConfirmPassword = $('#inputConfirmPassword').val();
      
        if(inputName == ""){
            $('#inputName-Error').html('Name is required.');
            return false;
        }else{
            $('#inputName-Error').html('');
        }

        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(inputEmail == ""){
            $('#inputEmail-Error').html('Email is required.'); 
            return false;
        }
        else if (!emailPattern.test(inputEmail)) {
            $("#inputEmail-Error").text("Invalid email format.");
            return false;
        }
        else{
            $('#inputEmail-Error').html('');
        }


        if(inputPhone == ""){
            $('#inputPhone-Error').html('Phone is required.');
            return false;
        }else{
            $('#inputPhone-Error').html('');
        }

        if(inputPassword == ""){
            $('#inputPassword-Error').html('Password is required.');
            return false;
        }else{
            $('#inputPassword-Error').html('');
        }

        if(inputPassword.length < 6){
            $('#inputPassword-Error').html('Password must be at least 6 characters.');
            return false;
        }else{
            $('#inputPassword-Error').html('');
        }

        if(inputPassword != inputConfirmPassword){
            $('#inputConfirmPassword-Error').html('Password don\'t match.');
            return false;
        }else{
            $('#inputConfirmPassword-Error').html('');
        }
 
         
        $("#createUserForm").submit();
         
    }); 

    //  registration event validation
    $("#registrationEvent").on('click', function(event)
    {
        // event.preventDefault();
        var inputName = $('#inputName').val();
        var inputEmail = $('#inputEmail').val();
        var inputPhone = $('#inputPhone').val();
        var inputPassword = $('#inputPassword').val();
        var inputConfirmPassword = $('#inputConfirmPassword').val();

        if(inputName == ""){
            $('#inputName-Error').html('Name is required.');
            return false;
        }else{
            $('#inputName-Error').html('');
        }

        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(inputEmail == ""){
            $('#inputEmail-Error').html('Email is required.'); 
            return false;
        }
        else if (!emailPattern.test(inputEmail)) {
            $("#inputEmail-Error").text("Invalid email format.");
            return false;
        }
        else{
            $('#inputEmail-Error').html('');
        }


        if(inputPhone == ""){
            $('#inputPhone-Error').html('Phone is required.');
            return false;
        }else{
            $('#inputPhone-Error').html('');
        }

        if(inputPassword == ""){
            $('#inputPassword-Error').html('Password is required.');
            return false;
        }else{
            $('#inputPassword-Error').html('');
        }

        if(inputPassword.length < 6){
            $('#inputPassword-Error').html('Password must be at least 6 characters.');
            return false;
        }else{
            $('#inputPassword-Error').html('');
        }

        if(inputConfirmPassword == ""){
            $('#inputConfirmPassword-Error').html('Confirm password is required.');
            return false;
        }else{
            $('#inputConfirmPassword-Error').html('');
        }

        if(inputPassword != inputConfirmPassword){
            $('#inputConfirmPassword-Error').html('Password don\'t match.');
            return false;
        }else{
            $('#inputConfirmPassword-Error').html('');
        }
 
         
        $("#registrationEventForm").submit();
         
    }); 

    
})