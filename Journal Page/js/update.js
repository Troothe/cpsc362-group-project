function updateJournalEntry(field, value) {
    
    $.ajax({
        url: "ajax/update_journal.php",
        method: "POST",
        data: {
            UpdateJournal: "yes",
            Field: field,
            Value: value,
        },
        dataType: "JSON",
        success:function(data, status) {
            
        },
        error:function() {
            
        },
        
    });    
    
}