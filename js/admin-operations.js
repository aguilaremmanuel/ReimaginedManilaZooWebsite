function showAddOperation() {
    document.getElementById('add-operation-modal').style.display = "flex";
}

document.getElementById("operationType").addEventListener("change", function() {
    
    let selectedOption = this.value;

    document.getElementById("specifiedOperationLabel").style.display = "none";
    document.getElementById("specifiedOperation").style.display = "none";

    if(selectedOption === "others") {
        document.getElementById("specifiedOperationLabel").style.display = "block";
        document.getElementById("specifiedOperation").style.display = "block";
    }
});

document.getElementById("cancel-btn").addEventListener("click", function() {
    document.getElementById('add-operation-modal').style.display = "none";
  });
  
function confirmCancelOperation(operationNo) {
    document.getElementById("confirm-cancel-operation-modal").style.display = "flex";
    document.getElementById("operationNo").value = operationNo;
}

document.getElementById("no-btn").addEventListener("click", function() {
    document.getElementById('confirm-cancel-operation-modal').style.display = "none";
  });
