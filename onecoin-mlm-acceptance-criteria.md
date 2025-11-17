# OneCoin MLM Software - Acceptance Criteria

## 1. MEMBER REGISTRATION & ACCOUNT MANAGEMENT

### 1.1 Registration System
- **AC-1.1.1**: System SHALL allow new member registration with one-time fee of €30
- **AC-1.1.2**: System SHALL capture and validate KYC (Know Your Customer) information including:
  - Full name, address, phone, email
  - Government ID verification
  - Date of birth
  - Tax identification number
- **AC-1.1.3**: System SHALL generate unique member ID upon successful registration
- **AC-1.1.4**: System SHALL assign members to sponsors using referral links or sponsor codes
- **AC-1.1.5**: System SHALL automatically create e-wallet in OnePayments system for all members

### 1.2 Package Purchase
- **AC-1.2.1**: System SHALL offer the following packages:
  - Activation Kit: Free (eBook only)
  - Starter: €100 (1,000 tokens, 50 AGC coins)
  - Trader: €500 (5,000 tokens, 250 AGC coins, OneCard)
  - Pro Trader: €1,000 (10,000 tokens, 500 AGC coins, OneCard)
  - Executive Trader: €3,000 (30,000 tokens, 1,500 AGC coins, OneCard)
  - Tycoon Trader: €5,000 (60,000 tokens, 2,500 AGC coins, OneCard)
- **AC-1.2.2**: System SHALL calculate Business Volume (BV) equal to package price
- **AC-1.2.3**: System SHALL issue OneTokens immediately upon package purchase
- **AC-1.2.4**: System SHALL issue AGC (Aurum Gold Coins) according to package level
- **AC-1.2.5**: System SHALL provide OneCard eligibility for Trader package and above

## 2. BINARY TREE STRUCTURE

### 2.1 Placement Rules
- **AC-2.1.1**: System SHALL implement binary tree with left and right legs
- **AC-2.1.2**: System SHALL allow sponsors to manually place new members on left or right
- **AC-2.1.3**: System SHALL provide auto-placement option with configurable preference (left/right/alternating)
- **AC-2.1.4**: System SHALL display real-time binary tree visualization
- **AC-2.1.5**: System SHALL track upline and downline relationships

### 2.2 Volume Tracking
- **AC-2.2.1**: System SHALL calculate and track Business Volume (BV) for each leg separately
- **AC-2.2.2**: System SHALL identify weaker leg (lesser volume) for bonus calculations
- **AC-2.2.3**: System SHALL implement monthly volume reset for weaker leg calculations
- **AC-2.2.4**: System SHALL maintain historical volume records

## 3. COMPENSATION PLAN

### 3.1 Direct Sales Bonus
- **AC-3.1.1**: System SHALL pay 10% commission on all personally sponsored sales
- **AC-3.1.2**: System SHALL calculate bonus based on Business Volume (BV)
- **AC-3.1.3**: System SHALL process direct sales bonus in real-time upon purchase

### 3.2 Network Bonus
- **AC-3.2.1**: System SHALL pay 10% of Business Volume accumulated on weaker leg
- **AC-3.2.2**: System SHALL calculate weaker leg as the side with lower total volume
- **AC-3.2.3**: System SHALL flush/carry forward volume according to compensation rules
- **AC-3.2.4**: System SHALL require matching bonus qualification for network bonus

### 3.3 Matching Bonus
- **AC-3.3.1**: System SHALL implement matching bonus based on package level:
  - Starter: No matching bonus
  - Trader: 10% on 1 generation
  - Pro Trader: 10% on 2 generations
  - Executive Trader: 10% on 2 generations (gen 1-2), 20% on generation 3
  - Tycoon: 10% on 2 generations, 20% on generation 3, 25% on generation 4
- **AC-3.3.2**: System SHALL require 2 personal sales (Trader or higher, 1 left, 1 right) for qualification
- **AC-3.3.3**: System SHALL calculate matching bonus on sponsored members' network bonuses

### 3.4 Start-up Bonus
- **AC-3.4.1**: System SHALL provide additional 10% bonus on direct sales for first 30 days
- **AC-3.4.2**: System SHALL require minimum BV of 5,500 to qualify
- **AC-3.4.3**: System SHALL track 30-day timer from registration date
- **AC-3.4.4**: System SHALL pay start-up bonus to mandatory account

### 3.5 Payment Distribution
- **AC-3.5.1**: System SHALL split commission payments:
  - 60% to cash account (withdrawable)
  - 40% to mandatory account (for repurchases)
- **AC-3.5.2**: System SHALL enforce split ratio on all bonus types

## 4. TOKEN AND COIN MANAGEMENT

### 4.1 OneToken System
- **AC-4.1.1**: System SHALL issue tokens according to package purchase
- **AC-4.1.2**: System SHALL provide internal exchange for token trading
- **AC-4.1.3**: System SHALL allow tokens to be:
  - Sold on OneExchange
  - Used for mining slots
  - Held for splits
- **AC-4.1.4**: System SHALL track token price in real-time

### 4.2 Token Splits
- **AC-4.2.1**: System SHALL implement automatic token doubling at predetermined member milestones
- **AC-4.2.2**: System SHALL limit splits per account:
  - Starter/Trader: 1 split maximum
  - Pro/Executive Trader: 1 split maximum
  - Tycoon: 2 splits maximum
- **AC-4.2.3**: System SHALL track split history and eligibility

### 4.3 Mining Pool
- **AC-4.3.1**: System SHALL allow token conversion to mining slots
- **AC-4.3.2**: System SHALL track mining difficulty progression
- **AC-4.3.3**: System SHALL distribute mined OneCoins to pool participants
- **AC-4.3.4**: System SHALL limit total mineable coins to 2.1 billion
- **AC-4.3.5**: System SHALL display real-time blockchain/mining visualization

### 4.4 Aurum Gold Coins (AGC)
- **AC-4.4.1**: System SHALL issue AGC based on package level
- **AC-4.4.2**: System SHALL maintain 1mg gold backing per AGC
- **AC-4.4.3**: System SHALL provide AGC trading on exchange
- **AC-4.4.4**: System SHALL track gold vault allocation numbers

## 5. RANK ADVANCEMENT SYSTEM

### 5.1 Rank Qualifications
- **AC-5.1.1**: System SHALL implement the following ranks:
  - Sapphire: Matching bonus qualified, 7,000 BV weaker leg
  - Ruby: Sapphire + 10,000 BV weaker leg, 40,000 total BV
  - Emerald: Ruby + 40,000 BV weaker leg, 80,000 total BV
  - Diamond: Emerald + 80,000 BV weaker leg, 200,000 total BV
  - Blue Diamond: Diamond + 200,000 BV weaker leg, 500,000 total BV
  - Black Diamond: Blue Diamond + 500,000 BV weaker leg, 1,500,000 total BV
  - Crown Diamond: Black Diamond + 1,500,000 BV weaker leg, 8,000,000 total BV

### 5.2 Rank Rewards
- **AC-5.2.1**: System SHALL award rank rewards:
  - Sapphire: Sapphire Pin
  - Ruby: Ruby Pin + iPhone 6
  - Emerald: Emerald Pin + MacBook Air
  - Diamond: Diamond Pin + Diamond Trip
  - Blue Diamond: Diamond Pin + Rolex
  - Black Diamond: Black Diamond Pin + Gold Rolex
  - Crown Diamond: Crown Diamond Ring + 500K EUR in AGC Coins

### 5.3 Rank Maintenance
- **AC-5.3.1**: System SHALL evaluate rank qualifications monthly
- **AC-5.3.2**: System SHALL maintain highest achieved rank for recognition
- **AC-5.3.3**: System SHALL require package minimums for rank qualification:
  - Sapphire/Ruby: Trader minimum
  - Emerald and above: Tycoon required

## 6. ONELIFE POINTS SYSTEM

### 6.1 Points Accumulation
- **AC-6.1.1**: System SHALL award daily OneLife points based on:
  - Organization size (1 to 250,000+ members)
  - Number of directly sponsored members
  - Package level owned
- **AC-6.1.2**: System SHALL calculate points according to 12-step progression table
- **AC-6.1.3**: System SHALL accumulate points daily

### 6.2 Points Redemption
- **AC-6.2.1**: System SHALL provide redemption catalog for:
  - Luxury holidays
  - Watches
  - Exclusive rewards
- **AC-6.2.2**: System SHALL track point balance in real-time
- **AC-6.2.3**: System SHALL process redemption requests

## 7. ONECARD PAYMENT SYSTEM

### 7.1 Card Issuance
- **AC-7.1.1**: System SHALL issue FREE MasterCard to Trader package and above
- **AC-7.1.2**: System SHALL link card to member's e-wallet
- **AC-7.1.3**: System SHALL enable ATM withdrawals worldwide

### 7.2 E-Wallet Integration
- **AC-7.2.1**: System SHALL credit all bonuses to e-wallet
- **AC-7.2.2**: System SHALL support international money transfers
- **AC-7.2.3**: System SHALL provide SMS and online fund management
- **AC-7.2.4**: System SHALL maintain transaction history

## 8. ONEACADEMY EDUCATION

### 8.1 Content Delivery
- **AC-8.1.1**: System SHALL provide 5 levels of educational content
- **AC-8.1.2**: System SHALL include:
  - Interactive videos
  - Presentations
  - Online quizzes
  - Manuals
- **AC-8.1.3**: System SHALL track course completion

### 8.2 Curriculum Topics
- **AC-8.2.1**: System SHALL cover:
  - What is Cryptocurrency
  - How to profit from trading cryptocurrency
  - Price prediction strategies
  - Gold investment education

## 9. EXCHANGE PLATFORM

### 9.1 OneExchange Trading
- **AC-9.1.1**: System SHALL provide real-time token trading
- **AC-9.1.2**: System SHALL display price charts and market depth
- **AC-9.1.3**: System SHALL support buy/sell orders
- **AC-9.1.4**: System SHALL track trading volume

### 9.2 Price Management
- **AC-9.2.1**: System SHALL implement price discovery mechanism
- **AC-9.2.2**: System SHALL prevent market manipulation
- **AC-9.2.3**: System SHALL provide price alerts
- **AC-9.2.4**: System SHALL maintain order book

## 10. REPORTING & ANALYTICS

### 10.1 Member Dashboard
- **AC-10.1.1**: System SHALL display:
  - Current rank and progress
  - Binary tree structure
  - Commission earnings
  - Token/coin balances
  - Volume statistics
  - Team performance

### 10.2 Financial Reports
- **AC-10.2.1**: System SHALL generate commission statements
- **AC-10.2.2**: System SHALL provide tax documentation
- **AC-10.2.3**: System SHALL track ROI and earnings projections
- **AC-10.2.4**: System SHALL export reports in multiple formats

## 11. COMPLIANCE & SECURITY

### 11.1 Regulatory Compliance
- **AC-11.1.1**: System SHALL implement KYC/AML procedures
- **AC-11.1.2**: System SHALL maintain audit trail of all transactions
- **AC-11.1.3**: System SHALL generate regulatory reports
- **AC-11.1.4**: System SHALL enforce geographic restrictions where required

### 11.2 Security Features
- **AC-11.2.1**: System SHALL implement two-factor authentication
- **AC-11.2.2**: System SHALL encrypt sensitive data
- **AC-11.2.3**: System SHALL maintain secure payment processing
- **AC-11.2.4**: System SHALL implement fraud detection

## 12. ADMINISTRATIVE FUNCTIONS

### 12.1 Back Office Management
- **AC-12.1.1**: System SHALL provide admin panel for:
  - Member management
  - Package configuration
  - Commission adjustments
  - System settings
  - Report generation

### 12.2 Customer Support
- **AC-12.2.1**: System SHALL include ticketing system
- **AC-12.2.2**: System SHALL log all support interactions
- **AC-12.2.3**: System SHALL provide knowledge base
- **AC-12.2.4**: System SHALL enable live chat support

## 13. MOBILE APPLICATION

### 13.1 Core Features
- **AC-13.1.1**: System SHALL provide iOS and Android apps
- **AC-13.1.2**: Apps SHALL include:
  - Member dashboard
  - Binary tree viewer
  - Commission tracking
  - E-wallet management
  - Token trading

### 13.2 Notifications
- **AC-13.2.1**: System SHALL send push notifications for:
  - New enrollments
  - Commission earnings
  - Rank advancements
  - System announcements

## 14. INTEGRATION REQUIREMENTS

### 14.1 External Systems
- **AC-14.1.1**: System SHALL integrate with:
  - Payment gateways
  - Banking systems
  - Cryptocurrency exchanges
  - Email/SMS providers
  - KYC verification services

### 14.2 API Development
- **AC-14.2.1**: System SHALL provide REST API for third-party integrations
- **AC-14.2.2**: System SHALL implement webhook notifications
- **AC-14.2.3**: System SHALL maintain API documentation

## 15. PERFORMANCE REQUIREMENTS

### 15.1 System Performance
- **AC-15.1.1**: System SHALL support 100,000+ concurrent users
- **AC-15.1.2**: Page load time SHALL be under 3 seconds
- **AC-15.1.3**: System SHALL maintain 99.9% uptime
- **AC-15.1.4**: System SHALL handle 10,000+ transactions per minute

### 15.2 Scalability
- **AC-15.2.1**: System SHALL scale horizontally for increased load
- **AC-15.2.2**: Database SHALL support sharding for growth
- **AC-15.2.3**: System SHALL implement caching for performance

## 16. TESTING REQUIREMENTS

### 16.1 Test Coverage
- **AC-16.1.1**: All compensation calculations must be unit tested
- **AC-16.1.2**: Binary tree placement must be thoroughly tested
- **AC-16.1.3**: Payment processing must undergo security testing
- **AC-16.1.4**: Load testing must verify performance requirements

---

**Note**: This document represents acceptance criteria based on the OneCoin compensation plan structure. Implementation should consider local regulations and compliance requirements in target markets.

**Version**: 1.0
**Date**: November 2024