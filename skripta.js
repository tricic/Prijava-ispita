function filtrirajTabelu(filter, idTabele)
{
    var tabela = document.getElementById(idTabele);

    var filterText = filter.value.toUpperCase();
    var redovi = tabela.getElementsByTagName("tr");
    
    // Loop kroz redove
    for (i = 0; i < redovi.length; i++)
    {
        var celije = redovi[i].getElementsByTagName("td");

        // Loop kroz celije (td elemente)
        for (j = 0; j < celije.length; j++)
        {
            var sadrzajCelije = celije[j].textContent || celije[j].innerText;
            
            if (sadrzajCelije.toUpperCase().indexOf(filterText) > -1)
            {
                redovi[i].style.display = "";
                break;
            }
            else
            {
                redovi[i].style.display = "none";
            }
        }
    }
}

function validirajInput(input, idTextElementa)
{
    var textElement = document.getElementById(idTextElementa);

    if (input.getAttribute("type") == "email")
    {
        if (validirajEmail(input.value) == false)
        {
            textElement.innerHTML = "Email nije validan."
        }
        else
        {
            textElement.innerHTML = "";
        }

        return;
    }

    if (input.value == "")
    {
        textElement.innerHTML = "Polje ne smije biti prazno!";
    }
    else
    {
        textElement.innerHTML = "";
    }
}

function validirajEmail(mail)
{
    var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    
    if (regex.test(mail))
    {
        return true;
    }
    else
    {
        return false;
    }
}