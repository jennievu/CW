let hoursWorked = 0, i = 1, payRate = 15, payMultiplier = 1.5;
const employee = [];
while (hoursWorked > -1) {
    hoursWorked = prompt("Current employee hours", -1);
    if (hoursWorked <= -1 || hoursWorked == null) {
        continue;
    }

    let pay = 0;
    if (hoursWorked > 40) {
        pay = (payRate * 40) + ((hoursWorked - 40) * payRate * payMultiplier);
    } else pay = payRate * hoursWorked;

    employee.push({ index: i, hours: hoursWorked, pay: pay });
    i++;
}

if (employee.length == 0) {
    document.getElementById("employee-container").appendChild(document.createTextNode('No Employee Found'));
    document.getElementById("employee-table").remove();
} else {
    employee.forEach((emp) => {
        const tr = document.createElement("tr");
        const indexTd = document.createElement("td");
        const hoursTd = document.createElement("td");
        const payTd = document.createElement("td");

        indexTd.appendChild(document.createTextNode(emp.index));
        hoursTd.appendChild(document.createTextNode(emp.hours));
        payTd.appendChild(document.createTextNode("$" + emp.pay));

        tr.appendChild(indexTd);
        tr.appendChild(hoursTd);
        tr.appendChild(payTd);
        document.getElementById("employee-table").appendChild(tr);
    });
}
