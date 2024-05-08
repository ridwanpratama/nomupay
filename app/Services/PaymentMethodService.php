<?php

namespace App\Services;

use App\Models\PaymentMethod;
use App\Models\PaymentMethodType;

class PaymentMethodService
{
    public function getPaymentMethodTypes()
    {
        $paymentMethodTypeModel = new PaymentMethodType();
        
        return $paymentMethodTypeModel->findAll();
    }

    public function getPaymentMethodByType($type)
    {
        $paymentMethods = new PaymentMethod();
        return $paymentMethods->where('type', $type)->findAll();
    }
    
}
