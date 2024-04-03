function validateNumero() {
    var numero = document.getElementById("numero").value;
    var numeroPattern = /^[0-9]{8}$/; // Uniquement 8 chiffres
    
    if (!numeroPattern.test(numero)) {
        document.getElementById("numero-error").innerHTML = "Le numéro doit être composé de 8 chiffres.";
        return false;
    }
    document.getElementById("numero-error").innerHTML = ""; 
    return true;
}

function validateCode() {
    var code = document.getElementById("code").value;
    var codePattern = /^[0-9]{4}$/; // Uniquement 4 chiffres
    
    if (!codePattern.test(code)) {
        document.getElementById("code-error").innerHTML = "Le code doit être composé de 4 chiffres.";
        return false;
    }
    document.getElementById("code-error").innerHTML = ""; // Efface le message d'erreur s'il est valide
    return true;
}
function onBlurNumero() {
    var numero = document.getElementById("numero").value;
    var numeroPattern = /^[0-9]{8}$/; // Uniquement 8 chiffres
    
    if (!numeroPattern.test(numero)) {
        document.getElementById("numero-error").innerHTML = "Le numéro doit être composé de 8 chiffres.";
    } else {
        document.getElementById("numero-error").innerHTML = ""; 
    }
}
function onBlurCode() {
    var code = document.getElementById("code").value;
    var codePattern = /^[0-9]{4}$/; // Uniquement 4 chiffres
    
    if (!codePattern.test(code)) {
        document.getElementById("code-error").innerHTML = "Le code doit être composé de 4 chiffres.";
    } else {
        document.getElementById("code-error").innerHTML = ""; // Efface le message d'erreur s'il est valide
    }
}

function validateEmail() {
    var email = document.getElementById("email").value;
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Expression régulière pour valider l'email
    
    if (!emailPattern.test(email)) {
        document.getElementById("email-error").innerHTML = "Adresse email invalide.";
        return false;
    }
    document.getElementById("email-error").innerHTML = ""; // Efface le message d'erreur s'il est valide
    return true;
}
function validateForm() {
    return validateEmail()&& validateNumero();
}
function validatePoids() {
    var poids = document.getElementById("poids").value;
    var poidsPattern = /^\d{1,2}$/; // Expression régulière pour valider un poids à un ou deux chiffres
    
    if (!poidsPattern.test(poids) || parseInt(poids) >= 30) {
        document.getElementById("poids-error").innerHTML = "Veuillez saisir un poids inférieur à 30.";
        return false;
    }
    document.getElementById("poids-error").innerHTML = ""; // Efface le message d'erreur s'il est valide
    return true;
}

function validateForm3() {
    return validatePoids();
}
function validateForm5() {  
    return validateCode();
}