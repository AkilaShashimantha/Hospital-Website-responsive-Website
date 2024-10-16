


function adminSignIn() {

    var adminEmail = document.getElementById("adminEmail");
    var adminPassword = document.getElementById("adminPassword");

    var f = new FormData();
    f.append("e", adminEmail.value);
    f.append("p", adminPassword.value);


    var r = new XMLHttpRequest();



    r.open("POST", "adminSignInProcess.php", true);
    r.send(f);

}

pShow.onclick = function () {
    let pShow = document.getElementById("pShow");
    let password = document.getElementById("adminPassword");

    if (password.type == "password") {
        password.type = "text";
        pShow.src = "images/eye-fill.svg"

    } else {

        password.type = "password";
        pShow.src = "images/eye-slash-fill.svg"
    }

}


function changeView1() {


    var appointmentBox = document.getElementById("appointmentBox");


    if (!appointmentBox.classList.toggle("d-none")) {

        appointmentBox.classList.toggle("d-block");
        newsBox.classList.toggle("d-none");
    }
    else {
        appointmentBox.classList.toggle("d-none");

    }



}

function changeView2() {

    var newsBox = document.getElementById("newsBox");

    if (!newsBox.classList.toggle("d-none")) {

        appointmentBox.classList.toggle("d-none");
        newsBox.classList.toggle("d-block");

    }
    else {
        newsBox.classList.toggle("d-none")

    }



}

//Doctor Form validation Part

/*function doctorvalidate(){

    const dname = document.getElementById('dname').value.trim();
    const nic = document.getElementById('nic').value.trim();
    const email = document.getElementById('email').value.trim();

    // Validate Doctor Name 
    if (dname === "") {
        alert("Please enter the Doctor's Name.");
        return false;
    }

    // Validate NIC
    const nicPattern = /^(\d{9}[VvXx]|\d{12})$/;
    if (nic === "" || !nicPattern.test(nic)) {
        alert("Please enter a valid NIC. It should be either 9 digits followed by V/v/X/x or 12 digits.");
        return false;
    }

    // Validate Email (
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === "" || !emailPattern.test(email)) {
        alert("Please enter a valid Email address.");
        return false;
    }

    // If all validations pass, return true
    return true;
    
}*/
function doctorvalidate() {
    const dname = document.getElementById('dname').value.trim();
    const nic = document.getElementById('nic').value.trim();
    const email = document.getElementById('email').value.trim();
    const speciality = document.getElementById('speciality').value;

    // Validate Doctor Name 
    if (dname === "") {
        alert("Please enter the Doctor's Name.");
        return false; // Prevent form submission
    }

    // Validate NIC
    const nicPattern = /^(\d{9}[Vv]|\d{12})$/;
    if (nic === "" || !nicPattern.test(nic)) {
        alert("Please enter a valid NIC. It should be either 9 digits followed by V/v/X/x or 12 digits.");
        return false; // Prevent form submission
    }

    // Validate Email
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === "" || !emailPattern.test(email)) {
        alert("Please enter a valid Email address.");
        return false; // Prevent form submission
    }

    // Validate Speciality
    if (!speciality) {
        alert("Please select a Speciality.");
        return false; // Prevent form submission
    }

    // If all validations pass, return true
    return true;
}

//Validate Appointment details

function appointmentValidate() {



    var pName = document.getElementById("pName").value;
    var nic = document.getElementById("nic").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var gender = document.getElementById("gender").value;
    var speciality2 = document.getElementById("speciality2").value;
    var doctor2 = document.getElementById("doctor2").value;
    var date2 = document.getElementById("date2").value;

    /*
    alert(pName);
    
    alert(nic);
    
    alert(email);
    
    alert(phone);
    
    alert(gender);
    
    alert(speciality2);
    
    alert(doctor2);
    
    alert(date2);
    */



    if (pName === "") {
        alert("Please Enter the patient name!");
    }

    const nicPattern = /^(\d{9}[Vv]|\d{12})$/;
    if (nic === "" || !nicPattern.test(nic)) {
        alert("Please enter a valid NIC. It should be either 9 digits followed by V/v or 12 digits.");
    }
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === "" || !emailPattern.test(email)) {
        alert("Please enter a valid Email address.");

    }

    if (phone === "") {
        alert("Please Enter Your phone number!")
    }

    if (gender === "") {
        alert("Please Select Patient Gender");
    }

    if (speciality2 === "") {
        alert("Please Select Speciality");
    }

    if (doctor2 === "") {
        alert("Please Select Doctor");
    }

    if (date2 === "") {
        alert("Please Select Date");
    }

else{


    if (pName !== "" && nic !== "" && email !== "" && phone !== "" && gender !== "" && speciality2 !== "" && doctor2 !== "" && date2 !== "") {

        var result = confirm("Are you sure you want to Confirm Appointment");

        if (result) {
            // User clicked 'Yes'

            var f = new FormData();
            f.append("pName", pName);
            f.append("nic", nic);
            f.append("email", email);
            f.append("phone", phone);
            f.append("gender", gender);
            f.append("doctor", doctor2);
            f.append("date", date2);

            var r = new XMLHttpRequest();

            r.onreadystatechange = function () {
                if (r.readyState == 4) {
                    var t = r.responseText;
                    if (t == "success") {
                     
                        alert(t);
                    } else {
                        
                        alert(t);
                    }
        
                }
            };
            
            r.open("POST", "process_payment.php", true);
            r.send(f);

            window.location = "payment.php";
        } else {
            // User clicked 'No'
            window.location.reload();

        }

    }

}

}




//Validating Patient form

function clearForm() {
    document.getElementById("patientForm").reset(); 
    document.getElementById("responseMessage").innerText = ""; 
}

// JavaScript Validation Function
function validateForm() {
    const name = document.getElementById("name").value.trim();
    const nic = document.getElementById("nic").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const date = document.getElementById("date").value;

    
    const nameRegex = /^[a-zA-Z\s]{2,}$/; 
    const nicRegex = /^(?:\d{9}[Vv]|\d{12})$/; 
    const phoneRegex = /^\d{10}$/; 

    
    if (!nameRegex.test(name)) {
        alert("Please enter a valid patient name (Add atleast 4 characters!).");
        return false;
    }

    
    if (!nicRegex.test(nic)) {
        alert("Please enter a valid NIC (9 digits followed by 'V' or 12 digits).");
        return false;
    }

    
    if (!phoneRegex.test(phone)) {
        alert("Please enter a valid phone number (10 digits).");
        return false;
    }

    
    if (date === "") {
        alert("Date is required.");
        return false;
    }

    return true; 
}

function insertPatient() {
    if (validateForm()) {

        document.getElementById("responseMessage").innerText = "Patient registered successfully!";
    }
}

//Connecting frontend to backend
document.getElementById("patientForm").addEventListener("submit", function(event) {
    event.preventDefault(); 
    var formData = new FormData(this); 

    fetch('addPatientProcess.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            alert(data.message); 
            document.getElementById("patientForm").reset(); 
        } else {
            alert(data.message); 
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("An error occurred while submitting the form."); 
    });
});

//update Patient
function updatePatient() {
    const formData = new FormData(document.getElementById("patientForm"));
    
    fetch('updatePatientProcess.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            alert(data.message); 
        } else {
            alert(data.message); 
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("An error occurred while updating the patient details.");
    });
}

//delete Patient
function deletePatient() {
    const nic = document.getElementById("nic").value; 

    if (!nic) {
        alert("Please enter NIC to delete the patient record");
        return;
    }

    const confirmDelete = confirm("Are you sure you want to delete this patient's record?");
    if (!confirmDelete) {
        return; 
    }

    const formData = new FormData();
    formData.append('nic', nic);

    fetch('deletePatientProcess.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  
    .then(data => {
        if (data.status === "success") {
            alert(data.message); 
            document.getElementById("patientForm").reset(); 
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("An error occurred while trying to delete the patient record: " + error.message);
    });
}


function doctorUpdate(){

var dName = document.getElementById("dname").value;
var nic = document.getElementById("nic").value;
var email = document.getElementById("email").value;
var speciality = document.getElementById("speciality").value;
/*
alert(dName);
alert(nic);
alert(email);
alert(speciality);
*/

var f = new FormData();

f.append("dName", dName);
f.append("nic", nic);
f.append("email", email);
f.append("speciality", speciality);

var r = new XMLHttpRequest();

r.onreadystatechange = function () {
    if (r.readyState == 4) {
        var t = r.responseText;
        if (t == "success") {
         
            alert("Details have been successfully updated.");
            
            document.getElementById("dname").value = "";
            document.getElementById("nic").value = "";
            document.getElementById("dnic").value = "";
            document.getElementById("email").value = "";
            document.getElementById("speciality").value = "";

        } else {
            
            alert(t);
        }

    }
};

r.open("POST", "doctorUpdateProcess.php", true);
r.send(f);


}

function deleteDoctor(){

    var nic = document.getElementById("nic").value;
   // alert(nic);

    var f = new FormData();
    f.append("nic", nic);

    var r = new XMLHttpRequest();


r.onreadystatechange = function () {
    if (r.readyState == 4) {
        var t = r.responseText;
        if (t == "success") {
         
            alert("Details have been successfully Deleted.");
            
            document.getElementById("dname").value = "";
            document.getElementById("nic").value = "";
            document.getElementById("dnic").value = "";
            document.getElementById("email").value = "";
            document.getElementById("speciality").value = "";

        } else {
            
            alert(t);
        }

    }
};

r.open("POST", "doctorDeleteProcess.php", true);
r.send(f);

}

