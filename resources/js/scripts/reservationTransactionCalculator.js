export function reservationTransactionCalculator() {
    var amount = $("#booking-payment-amount");
    var exchange_rate = $("#booking-payment-exchange-rate");
    var damage_insurance = $("#booking-payment-damage-insurance");
    var comission = $("#booking-payment-comission");
    var bank_fees = $("#booking-payment-bank-fees");
    var net_comission = $("#booking-payment-net-comission");
    var pm_amount = $("#booking-payment-pm-amount");

    var calculate = function() {
        var amountVal = parseFloat(amount.val());
        var damageInsuranceVal = parseFloat(damage_insurance.val());
        var exchangeRateVal = parseFloat(exchange_rate.val());
        // var comissionVal = parseFloat(comission.val());
        var bankFees = parseFloat(bank_fees.val());
        var netComission = parseFloat(net_comission.val());

        var comissionAmount = bankFees + netComission;
        var pm_amountVal = ((amountVal - damageInsuranceVal) - comissionAmount) * exchangeRateVal;
        
        if(!Number.isNaN(pm_amountVal)) {
            pm_amount.val(pm_amountVal);
        }
    }

    if(pm_amount.length) {
        amount.on('change keyup', calculate);
        exchange_rate.on('change keyup', calculate);
        comission.on('change keyup', calculate);
        bank_fees.on('change keyup', calculate);
        net_comission.on('change keyup', calculate);
    }
}
