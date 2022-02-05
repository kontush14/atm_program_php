<?php
    class CashMachine {

        /**
         * Available bill values in the ATM. Consider quantities are unlimited.
         */
        private $bills = array(2, 5, 10, 20, 50, 100);
        private $money_left;
        private $cash = array();

        function __construct() {
            rsort($this->bills);
        }

        /**
         * Returns the bills that should be distributed for a given withdraw amount and available bills,
         * MINIMIZING the total number of distributed bills.
         * Ex: getBills(62) => array(2 => 1, 10 => 1, 50 => 1).
         *
         * @param int $withdrawAmount How much we want to withdraw from the ATM
         * @throws WithdrawException if the exact amount cannot be gathered with the available bills.
         * @return array Associative array representing the bills that should be distributed by the cash machine.
         */
        public function getBills($withdrawAmount) {
            $this->cash = array();
            $this->money_left = $withdrawAmount;
            while ($this->money_left > 0) {
                if ($this->money_left < min($this->bills)) {
                    throw new WithdrawException('This amount cannot be paid.');
                }
                $bill = $this->configureBills();
                $this->cash[] = $bill;
                $this->money_left -= $bill;
            }
            return array_count_values($this->cash);
        }

        private function configureBills() {
            foreach ($this->bills as $bill) {
                $division = $this->money_left / $bill;
                $rest = $this->money_left % $bill;
                if ( ($division >= 1) && ( $rest > (min($this->bills)+1) || ($rest === min($this->bills)) || ($rest === 0) ) ) {
                    return $bill;
                }
            } 
            return min($this->bills);
        }
    }

?>