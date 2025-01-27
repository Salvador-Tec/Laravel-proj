<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body>
    <div class="bg-gray-200 flex justify-center items-center h-screen">
        <div class="bg-white p-6 rounded-md md:w-1/3 w-full mx-4">
            <form action="{{ route('updatePayment', ['reservation' => $reservation->id]) }}" method="POST">
                @csrf
                @method("PUT")

                <!-- Payment Method -->
                <div class="my-5 w-full flex items-center">
                    <label class="w-44" for="payment_method">Payment Method: </label>
                </div>

                <div class="my-5 w-full flex items-center">
                    <input type="radio" id="tpe" name="payment_method" value="TPE" class="mr-2" onchange="showAmountField()">
                    <label for="tpe" class="mr-4">TPE</label>

                    <input type="radio" id="cheque" name="payment_method" value="Cheque" class="mr-2" onchange="showAmountField()">
                    <label for="cheque" class="mr-4">Chèque</label>

                    <input type="radio" id="espèce" name="payment_method" value="Espèce" class="mr-2" onchange="showAmountField()">
                    <label for="espèce" class="mr-4">Espèce</label>

                    <input type="radio" id="virement" name="payment_method" value="Virement" class="mr-2" onchange="showAmountField()">
                    <label for="virement" class="mr-4">Virement</label>
                </div>

                <!-- Amount Paid (only shown if a valid payment method is selected) -->
                <div class="my-5 w-full flex items-center" id="amount-container" style="display: none;">
                    <label class="w-44" for="amount_paid">Amount Paid: </label>
                    <input type="number" name="amount_paid" id="amount_paid" step="0.01" class="w-full rounded-md border border-gray-300 py-1.5 px-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-inset focus:ring-pr-400" placeholder="Enter Amount Paid">
                </div>

                <!-- Confirm Button -->
                <div class="my-5 w-full flex items-center" id="confirm-button-container" style="display: none;">
                    <button type="button" id="confirm-button" class="p-3 w-full text-white rounded-md bg-blue-500 hover:bg-blue-700" onclick="confirmAmount()">Confirm</button>
                </div>

                <!-- Remaining Amount -->
                <div class="my-5 w-full flex items-center" id="remaining-container" style="display: none;">
                    <label class="w-44" for="remaining_amount">Remaining Amount: </label>
                    <input type="text" name="remaining_amount" id="remaining_amount" class="w-full rounded-md border border-gray-300 py-1.5 px-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-inset focus:ring-pr-400" readonly>
                </div>

                <!-- Payment Status (Paid or Not Paid) -->
                <div class="my-5 w-full flex items-center" id="payment-status-container" style="display: none;">
                    <label for="payment_status" class="w-44">Status de Paiement: </label>
                    <select name="payment_status" id="payment_status" class="w-full rounded-md border border-gray-300 py-1.5 px-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-inset focus:ring-pr-400">
                        <option disabled selected>-- Sélectionnez --</option>
                        <option value="paid">Payé</option>
                        <option value="not_paid">Non payé</option>
                        <option value="Partiellement payé">Partiellement payé</option>
                    </select>
                </div>

                <!-- Hidden input for currentAmountPaid -->
                <input type="hidden" name="current_amount_paid" id="current_amount_paid" value="{{ $reservation->amount_paid }}">

                <!-- Save Button -->
                <div id="save-button-container" style="display: none;">
                    <button type="submit" class="p-3 w-full text-white rounded-md bg-blue-500 hover:bg-blue-700">Sauvegarder</button>
                </div>

                <!-- OK Button -->
                <div id="ok-button-container" style="display: none;">
                    <button type="submit" name="payment_status" value="payed" class="p-3 w-full text-white rounded-md bg-green-500 hover:bg-green-700">Sauvegarder</button>
                </div>

                <!-- Submit and Cancel buttons -->
                <div class="flex justify-center mt-12">
                    <a href="{{ route('adminDashboard') }}" class="p-3 w-full text-white text-center rounded-md me-2 bg-red-600 hover:bg-red-800">
                        <button type="button">Cancel</button>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
    const totalAmount = @json($reservation->total_price); // Montant total de la réservation
    let currentAmountPaid = @json($reservation->amount_paid); // Montant payé actuellement
    let previousRemainingAmount = totalAmount - currentAmountPaid; // Montant restant à partir de la fois précédente

    // Affichage initial du montant restant
    document.getElementById('remaining_amount').value = previousRemainingAmount.toFixed(2);

    // Fonction pour mettre à jour le statut de paiement
    function updatePaymentStatus() {
        const paymentStatusSelect = document.getElementById('payment_status');
        if (currentAmountPaid >= totalAmount) {
            paymentStatusSelect.value = 'paid';
        } else if (currentAmountPaid > 0) {
            paymentStatusSelect.value = 'Partiellement payé';
        } else {
            paymentStatusSelect.value = 'not_paid';
        }
    }

    // Mettre à jour le statut de paiement au chargement de la page
    updatePaymentStatus();

    function showAmountField() {
        const amountContainer = document.getElementById('amount-container');
        const confirmButtonContainer = document.getElementById('confirm-button-container');
        const paymentMethods = document.getElementsByName('payment_method');
        let isPaymentMethodSelected = false;

        for (let i = 0; i < paymentMethods.length; i++) {
            if (paymentMethods[i].checked) {
                isPaymentMethodSelected = true;
                break;
            }
        }

        if (isPaymentMethodSelected) {
            amountContainer.style.display = 'block';
            confirmButtonContainer.style.display = 'block';
        } else {
            amountContainer.style.display = 'none';
            confirmButtonContainer.style.display = 'none';
        }
    }

    function confirmAmount() {
        const amountPaid = parseFloat(document.getElementById('amount_paid').value); // Montant payé lors de cette fois
        const remainingAmountField = document.getElementById('remaining_amount'); // Champ pour le reste
        const remainingContainer = document.getElementById('remaining-container');
        const saveButtonContainer = document.getElementById('save-button-container');
        const okButtonContainer = document.getElementById('ok-button-container');

        if (isNaN(amountPaid) || amountPaid <= 0) {
            alert("Veuillez entrer un montant valide.");
            return;
        }

        // Calculer le nouveau montant restant
        previousRemainingAmount -= amountPaid;

        // Mise à jour du champ caché pour le montant total payé
        currentAmountPaid += amountPaid;
        document.getElementById('current_amount_paid').value = currentAmountPaid;

        // Mise à jour du montant restant
        remainingAmountField.value = previousRemainingAmount.toFixed(2);

        // Vérification si le montant payé est égal, inférieur ou supérieur au montant total
        if (previousRemainingAmount === 0) {
            okButtonContainer.style.display = 'block';
            remainingContainer.style.display = 'none';
            saveButtonContainer.style.display = 'none';
        } else if (previousRemainingAmount > 0) {
            remainingContainer.style.display = 'block';
            saveButtonContainer.style.display = 'block';
            okButtonContainer.style.display = 'none';
        } else if (previousRemainingAmount < 0) {
            alert("Le montant payé ne peut pas dépasser le montant total.");
        }

        // Mettre à jour le statut de paiement après confirmation
        updatePaymentStatus();
    }
    </script>

</body>

</html>
