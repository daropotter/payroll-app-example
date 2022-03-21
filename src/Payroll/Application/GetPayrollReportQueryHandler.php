<?php

declare(strict_types=1);

namespace App\Payroll\Application;

use App\Payroll\Domain\PayrollFacade;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

/** @psalm-immutable */
#[AsMessageHandler]
class GetPayrollReportQueryHandler
{
    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus, private PayrollFacade $payrollFacade)
    {
        $this->messageBus = $messageBus;
    }

    public function __invoke(GetPayrollReportQuery $query)
    {
        $payroll = $this->payrollFacade->getCurrentPayroll();
        return new GetPayrollReportQueryResult($payroll->getSalaries());
    }
}
