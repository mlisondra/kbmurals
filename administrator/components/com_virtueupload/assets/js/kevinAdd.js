function del_file( form ) {
        var if_checked = 0;


                if(form.elements['selectedfiles'].checked)
                {
                        if_checked = 1;
                }

        for (var i=0; i < form.elements['selectedfiles'].length; i++)
        {

                if(form.elements['selectedfiles'][i].checked)
                {
                        if_checked = 1;
                        break;
                }
        }
        if(if_checked == 0)
        {
                alert('please select one file at least!');
                return false;
        }
        

		form.task.value='delete_file'; 
        return true;
}

function add_file( form ) {

        
		form.task.value='add_file'; 
        return true;
}