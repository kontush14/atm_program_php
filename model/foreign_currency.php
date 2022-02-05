<?php
    /* We need this class to obtain the bank`s exchange rate data. We use this data for the Balance View function
    so that the user can view the balance of their balance not only in uah, but also in dollars and euros.
    */
    class ForeignCurrency
    {
        public $link;

        //Using this function, we get an element from the array - the dollar
        public function getCurrencyUSD()
        {
            $Usd = $this->getCurrency();
            $usd_balance = 1 / $Usd[0]['buy'];

            return $usd_balance;
        }

        //Using this function, we get an element from the array - the euro
        public function getCurrencyEUR()
        {
            $Eur = $this->getCurrency();
            $eur_balance = 1 / $Eur[1]['buy'];

            return $eur_balance;
        }

        // Using this function, we get an array of data that contains the exchange rate of the bank
        public function getCurrency()
        {
            $this->link = "https://api.privatbank.ua/p24api/pubinfo?exchange&json&coursid=11";
            $response = file_get_contents($this->link);
            $response = json_decode($response, true);

            return $response;
        }
    }
?>