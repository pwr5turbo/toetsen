    function changetest(){
        var naam = document.getElementById("naam").value;
        var land = document.getElementById("land").value;
        var id = document.getElementById("id").value;
        var checkdiv = document.getElementById("check");
        let name = false;
        let country = false;

        console.log(id);

        if(naam.length > 2 && naam.length < 50){
            console.log(naam + " is grooter dan 2 en kleiner dan 50");
            name = true;
        }else{
            console.log(naam + " is niet grooter dan 2 of niet kleiner dan 50");
            checkdiv.innerHTML += "De naam moet langer dan 2 zijn en korter dan 50<br>";
            checkdiv.style.display = "block";
        }

        if(land.length > 2 && land.length < 50){
            console.log(land + " is grooter dan 2 en kleiner dan 50");
            country = true;
        }
        else
        {
            console.log(land + " is niet grooter dan 2 of niet kleiner dan 50");
            checkdiv.innerHTML += "De land naam moet langer dan 2 zijn en korter dan 50. <br>";
            checkdiv.style.display = "block";
        }

        if (name && country) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "edit.php?id=" + id, true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
            var data = "id=" + encodeURIComponent(id) + "&naam=" + encodeURIComponent(naam) + "&land=" + encodeURIComponent(land);
        
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        var responseData = JSON.parse(xhr.responseText);
                        console.log(responseData);
                    
                        if (responseData.success) {
                            window.location.href = "CRUD.php";
                        }
                    }
                }
            };
        
            xhr.send(data);
        }
        


    }

    function dropdown()
    {
        var toevoegenDiv = document.getElementById('toevoegen');

        toevoegenDiv.style.display = "flex";
    }

    function hide(){
        var toevoegenDiv = document.getElementById('toevoegen');

        toevoegenDiv.style.display = "none";
    }

    function add() {
        var naam = document.getElementById("naam").value;
        var land = document.getElementById("land").value;
        var checkdiv = document.getElementById("check");
        let name = false;
        let country = false;
    
        if (naam.length > 2 && naam.length < 50) {
            console.log(naam + " is greater than 2 and less than 50");
            name = true;
        } else {
            console.log(naam + " is not greater than 2 or not less than 50");
            checkdiv.innerHTML += "The name must be longer than 2 and shorter than 50<br>";
            checkdiv.style.display = "block";
        }
    
        if (land.length > 2 && land.length < 50) {
            console.log(land + " is greater than 2 and less than 50");
            country = true;
        } else {
            console.log(land + " is not greater than 2 or not less than 50");
            checkdiv.innerHTML += "The country name must be longer than 2 and shorter than 50. <br>";
            checkdiv.style.display = "block";
        }
    
        if (name && country) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "CRUD.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
            var data = "&naam=" + encodeURIComponent(naam) + "&land=" + encodeURIComponent(land);
    
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        var responseData = JSON.parse(xhr.responseText);
                        console.log(responseData);
    
                        // Check for success and display a message if needed
                        if (responseData.success) {
                            alert(responseData.message);
                            // Additional logic if needed after successful insertion
                        } else {
                            alert("Error: " + responseData.message);
                        }
                    }
                }
            };
    
            xhr.send(data);
            var toevoegenDiv = document.getElementById('toevoegen');
            toevoegenDiv.style.display = "none";
        }
    }