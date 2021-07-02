function updateThoughts(thought, value) {
    console.log(thought);
    console.log(value);
    
    $.ajax({
        url: "ajax/update_thoughts.php",
        method: "POST",
        data: {
            UpdateJournal: "yes",
            Field: thought,
            Value: value,
        },
        dataType: "JSON",
        success:function(data, status) {
            
        },
        error:function() {
            
        },
        
    });  
}