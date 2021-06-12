<?php 


class BillingDetails{
    public static function insertDetails($con,$agreement,$token,$username){
        $query = $con->prepare("INSERT INTO billingDetails (agreementId, nextBillingDate,token,username) 
        VALUES (:agreementId,:nextBDate,:token,:username)");
        $agreementDetails = $agreement->getAgreementDetails();
        $query->bindValue(":agreementId",$agreement->getId());
        $query->bindValue(":nextBDate",$agreement->getNextBillingDate());
        $query->bindValue(":token",$token);
        $query->bindValue(":username",$username);

        $query->execute();
    }
}