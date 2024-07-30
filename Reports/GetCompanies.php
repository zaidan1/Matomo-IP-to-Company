<?php
namespace Piwik\Plugins\IPtoCompany\Reports;

use Piwik\Piwik;
use Piwik\Plugin\Report;
use Piwik\Plugin\ViewDataTable;
use Piwik\Widget\WidgetsList;
use Piwik\Report\ReportWidgetFactory;

use Piwik\View;

class GetCompanies extends Base
{
    // Explicitly define properties
    protected $columns;
    protected $metrics;

    protected function init()
    {
        parent::init();

        $this->name          = Piwik::translate('IPtoCompany_Companies');
        $this->dimension     = null;
        $this->documentation = Piwik::translate('');
        $this->subcategoryId = Piwik::translate('IPtoCompany_Companies');
        $this->order         = 26;

        // Initialize properties
        $this->metrics = ['nb_visits'];

        $this->columns = [
            'IP',
            'company',
            'last_visit_time',
            'type',
            'nb_visits',
            'last_visit_duration',
            'referrer_type',
            'referrer_name',
            'device',
            'country',
            'city'
        ];
    }

    public function configureView(ViewDataTable $view)
    {
        if (!empty($this->dimension)) {
            $view->config->addTranslations(['label' => $this->dimension->getName()]);
        }

        $view->config->show_search = true;
        $view->config->show_pagination_control = true;
        $view->config->show_limit_control = true;
        $view->config->show_periods = true;
        $view->config->show_bar_chart = false;
        $view->config->show_pie_chart = false;
        $view->config->show_tag_cloud = false;

        $view->config->addTranslation('company', Piwik::translate('IPtoCompany_Company'));
        $view->config->addTranslation('last_visit_time', Piwik::translate('IPtoCompany_LastVisit'));
        $view->config->addTranslation('type', Piwik::translate('IPtoCompany_Type'));
        $view->config->addTranslation('nb_visits', Piwik::translate('IPtoCompany_NumberOfVisits'));
        $view->config->addTranslation('last_visit_duration', Piwik::translate('IPtoCompany_LastVisitDuration'));
        $view->config->addTranslation('referrer_type', Piwik::translate('IPtoCompany_ReferrerType'));
        $view->config->addTranslation('referrer_name', Piwik::translate('IPtoCompany_ReferrerName'));
        $view->config->addTranslation('device', Piwik::translate('IPtoCompany_Device'));
        $view->config->addTranslation('country', Piwik::translate('IPtoCompany_Country'));
        $view->config->addTranslation('city', Piwik::translate('IPtoCompany_City'));

        $view->config->columns_to_display = $this->columns;
    }

    public function getRelatedReports()
    {
        return [];
    }

    public function configureWidgets(WidgetsList $widgetsList, ReportWidgetFactory $factory)
    {
        $widgetsList->addWidgetConfig($factory->createWidget());
    }
}

