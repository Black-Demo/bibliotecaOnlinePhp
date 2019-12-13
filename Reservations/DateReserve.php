<?php
    class DateReserve{
        var $currentDate;
        var $dateDevolution;
        var $dateGetBook;
        var $datePenalty = 0;

        function DateReserve($dateGetBook, $dateDevolution){
            $this->currentDate = new DateTime();
            $this->dateGetBook = $dateGetBook;
            $this->dateDevolution = $dateDevolution;
        }

        function calDateDiference($dateGetBook, $dateDevolution){
            if (!(strtotime($dateGetBook)<=strtotime($dateDevolution)))
                return (date_diff($dateGetBook,$dateDevolution))->format('%R%a días');
        }

        function daysToDate($days){
            return new DateTime($days);
        }

        function addDays($days){
            return date_add($this->datePenalty,$days);
        }

    }
?>
