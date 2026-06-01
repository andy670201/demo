<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\News;
use App\Models\Service;
use App\Models\Contact;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@nexcore.com',
            'password' => Hash::make('directx9'),
        ]);

        $newsItems = [
            [
                'title' => 'NexCore Technology 榮獲 2024 最佳雲端服務獎',
                'slug' => 'nexcore-cloud-award-2024',
                'content' => 'NexCore Technology 在今年度的科技大獎評選中脫穎而出，榮獲最佳雲端服務獎。本次獲獎代表我們在雲端基礎設施、安全性及服務品質方面的卓越表現獲得業界肯定。我們的雲端解決方案已協助超過 200 家企業完成數位轉型，大幅提升其業務效率與競爭力。未來我們將持續創新，為客戶提供更優質的雲端服務體驗。',
                'summary' => 'NexCore Technology 榮獲 2024 年度最佳雲端服務獎，彰顯我們在雲端領域的領導地位。',
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'AI 整合服務全面升級：智能化企業解決方案',
                'slug' => 'ai-integration-upgrade-2024',
                'content' => '隨著人工智慧技術的快速發展，NexCore Technology 宣布全面升級 AI 整合服務。新版本引入了先進的機器學習模型，能夠更精確地分析企業數據，提供個性化的業務建議。我們的 AI 平台現在支援自然語言處理、圖像識別及預測分析等功能，幫助企業在競爭激烈的市場中保持領先優勢。此次升級預計將為使用 AI 服務的客戶提升 40% 的運營效率。',
                'summary' => '全新 AI 整合服務升級，引入先進機器學習模型，助力企業智能化轉型。',
                'is_published' => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => '資安威脅報告：企業如何防範新型網路攻擊',
                'slug' => 'cybersecurity-threat-report-2024',
                'content' => '近期網路安全威脅日益嚴峻，NexCore Technology 資安研究團隊發布最新威脅報告。報告指出，勒索軟體攻擊數量較去年增加 65%，且攻擊手法更加精密複雜。我們建議企業立即採取以下措施：定期更新系統補丁、實施多因素驗證、建立完善的資料備份機制，以及提升員工資安意識培訓。NexCore 提供全方位資安服務，協助企業建立堅固的防護體系。',
                'summary' => '最新資安威脅報告揭示勒索軟體攻擊激增，NexCore 提供全面防護建議。',
                'is_published' => true,
                'published_at' => now()->subDays(15),
            ],
            [
                'title' => 'NexCore ERP 系統新功能發布：全面整合供應鏈管理',
                'slug' => 'erp-supply-chain-integration-2024',
                'content' => 'NexCore Technology 最新版 ERP 系統正式發布，重點強化供應鏈管理功能。新系統整合了即時庫存追蹤、智能採購建議及供應商績效評估等模組，為企業提供端到端的供應鏈可視性。此外，新版本還新增了行動應用程式支援，讓管理人員隨時掌握業務動態。目前已有 50 家企業完成升級，平均庫存成本降低 25%，訂單處理時間縮短 30%。',
                'summary' => '全新 ERP 系統整合供應鏈管理，助企業降低庫存成本並提升訂單處理效率。',
                'is_published' => true,
                'published_at' => now()->subDays(20),
            ],
            [
                'title' => '技術合作夥伴計畫啟動：共建數位生態系統',
                'slug' => 'tech-partner-program-launch-2024',
                'content' => 'NexCore Technology 正式啟動技術合作夥伴計畫，邀請各界優秀的科技企業共同建構完整的數位生態系統。此計畫提供技術支援、培訓資源及市場推廣資源，協助合作夥伴拓展業務版圖。首批合作夥伴將享有優先技術存取權、聯合行銷機會及收益分潤方案。目前已有 15 家企業成功加入計畫，共同為客戶提供更完整的數位解決方案。',
                'summary' => 'NexCore 技術合作夥伴計畫正式啟動，共建完整數位生態系統，首批 15 家企業加入。',
                'is_published' => true,
                'published_at' => now()->subDays(25),
            ],
        ];

        foreach ($newsItems as $news) {
            News::create($news);
        }

        $services = [
            [
                'title' => '雲端解決方案',
                'description' => '提供企業級雲端基礎設施建置、遷移及管理服務。涵蓋公有雲、私有雲及混合雲架構規劃，確保系統高可用性、彈性擴展及成本最佳化，協助企業快速完成數位轉型。',
                'icon' => 'Cloud',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'AI 智能整合',
                'description' => '將人工智慧與機器學習技術整合至企業現有系統，提供智能客服、預測分析、自動化流程及圖像識別等解決方案，大幅提升業務效率與決策品質。',
                'icon' => 'Brain',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => '資訊安全服務',
                'description' => '提供全方位資安防護，包括滲透測試、弱點掃描、SOC 監控、事件應變及資安培訓。協助企業建立完善的資安體系，符合 ISO 27001 等國際標準，抵禦各類網路威脅。',
                'icon' => 'Shield',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'ERP 企業系統',
                'description' => '客製化 ERP 系統開發與導入，整合財務、人資、採購、庫存及生產管理等模組。支援行動裝置存取，提供即時報表與數據分析，幫助企業全面掌握營運狀況。',
                'icon' => 'Database',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'App 應用開發',
                'description' => '專業 iOS、Android 及跨平台行動應用程式開發服務。從需求分析、UI/UX 設計、程式開發到上架維護，提供完整的行動解決方案，助企業拓展行動商機。',
                'icon' => 'Smartphone',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => '技術顧問服務',
                'description' => '由資深技術專家提供 IT 策略規劃、系統架構設計、技術評估及數位轉型諮詢。協助企業制定符合業務目標的技術路線圖，優化現有系統架構，提升整體技術競爭力。',
                'icon' => 'Users',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        $contacts = [
            [
                'name' => '王大明',
                'email' => 'wang@example.com',
                'subject' => '詢問雲端服務方案',
                'message' => '您好，我們公司正在評估雲端遷移方案，想了解貴公司提供的雲端服務內容及報價，麻煩請回覆，謝謝。',
                'is_read' => false,
            ],
            [
                'name' => '李小華',
                'email' => 'li@company.tw',
                'subject' => 'ERP 系統客製化需求',
                'message' => '我們是一家製造業公司，目前需要一套整合生產管理與庫存控制的 ERP 系統，想了解貴公司的客製化開發服務。',
                'is_read' => true,
            ],
            [
                'name' => '張志遠',
                'email' => 'chang@startup.io',
                'subject' => 'AI 整合服務合作提案',
                'message' => '我們是一家新創公司，希望在產品中整合 AI 功能，想與貴公司討論技術合作的可能性，請問方便安排一個會議嗎？',
                'is_read' => false,
            ],
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}
