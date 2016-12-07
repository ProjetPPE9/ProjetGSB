function afficheMontantFrais()
{
    var idFrais = document.getElementById('cbFrais').value;
    
    if(idFrais == "ETP")
    {
        document.getElementById('txtMontant').setAttribute('value', "110.00");
    }
    else if(idFrais == "KM")
    {
        document.getElementById('txtMontant').setAttribute('value', "0.62");
    }
    else if(idFrais == "NUI")
    {
        document.getElementById('txtMontant').setAttribute('value', "80.00");
    }
    else if(idFrais == "REP")
    {
        document.getElementById('txtMontant').setAttribute('value', "25.00");
    }
    
}
