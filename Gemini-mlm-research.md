

# **Analysis of On-Premise MLM Software Solutions for Complex Binary Tokenomic Models**

## **1.0 Executive Summary of Findings and Recommendations**

### **1.1 Primary Objective**

The primary objective of this report is to conduct an exhaustive analysis of on-premise, self-hosted Multi-Level Marketing (MLM) software solutions. The analysis seeks to identify viable open-source, free, and commercial (COTS) platforms capable of replacing an existing system. The core requirement is the implementation of a highly specific, complex compensation model based on the OneCoin plan 1, modified to utilize a native cryptocurrency token designated "FCO." The evaluation is strictly limited to solutions that support on-premise deployment and a Binary compensation plan.

### **1.2 Summary of Findings**

A comprehensive review of the market and relevant technical documentation reveals a critical conclusion: **no off-the-shelf software solution, whether open-source or commercial, exists that can natively execute the specified OneCoin compensation model.**

The plan's requirements, specifically the **60/40 "Split E-Wallet"** (dividing all bonuses into "cash" and "mandatory" accounts) 1 and the **"Token Split" (Account Doubling)** mechanic 1, are non-standard, proprietary tokenomic functions.

* **Open-Source (FOSS) Solutions:** The FOSS landscape is ill-suited for this project. It is comprised primarily of simplistic PHP scripts 2 or a single, viable-but-impractical framework (genelet/mlm) built on the esoteric Perl programming language.4 The development cost, risk, and maintenance burden of building the required FinTech modules from scratch on such a platform are prohibitive.  
* **Commercial (COTS) Solutions:** The viable path lies with enterprise-grade, on-premise COTS vendors. These companies provide a robust, scalable base platform and a business model centered on deep customization.6 The project's success is therefore contingent on the *architectural extensibility* of the chosen platform.

### **1.3 Core Recommendation**

A strategy of procuring an enterprise-grade, on-premise license for a high-end commercial platform is strongly recommended. This project must be scoped, budgeted, and managed as a **heavy customization and development project** built upon a licensed COTS core, not as a simple software deployment.

Based on an analysis of features, deployment models, and documented customization capabilities, the primary candidates for detailed vendor negotiation are:

1. **Infinite MLM Software** 9  
2. **Neo MLM Software** 10

The feasibility of custom-building the "Token Split" and "60/40 Split Wallet" modules must be the central line of inquiry during the procurement process.

### **1.4 Key Architectural Strategy**

The project requirement for an "on-site server" (on-premise) combined with a native "token" (FCO) creates an architectural ambiguity. A "token" often implies a decentralized smart contract (e.g., ERC-20), while an "on-site server" implies a centralized system.

The OneCoin model itself, which this project seeks to replicate, provides the solution. The OneCoin PDF describes a centralized exchange 1 and a KYC-gated system 1, which are hallmarks of a centralized, private platform, not a decentralized, public one.

Therefore, the most pragmatic, secure, and cost-effective architecture is to implement the FCO token as a **private, internal ledger** (i.e., a custom table within the on-premise software's SQL database).

This centralized architecture provides two critical advantages:

1. It gives the platform administrator full, auditable control over the token supply and user balances, which is necessary for a regulated environment.  
2. It makes the complex "Token Split" mechanic 1 technically trivial to implement (e.g., a simple, admin-triggered SQL update function), rather than an exponentially complex and expensive smart contract migration.

This report will proceed under this recommended architectural assumption.

## **2.0 Deconstruction of the OneCoin Compensation Model as a Technical Benchmark**

### **2.1 Overview**

To effectively evaluate software solutions, the marketing-oriented OneCoin compensation plan 1 must be translated into a definitive **Benchmark Feature Requirement Set**. This set of technical and functional requirements forms the evaluation metric used for the remainder of this report.

### **2.2 Core Compensation Logic**

These features represent the standard "MLM" portion of the software, which many high-end platforms are designed to handle.

* **Direct Sales Bonus:** 10% of the Business Volume (BV) from personally sponsored members.1 This is a standard, universally supported referral bonus.  
* **Network Bonus (Binary):** 10% of the accumulated Business Volume (BV) from the "weaker leg" of the binary genealogical tree.1 This is the central compensation plan and a mandatory filter for this analysis.  
* **Matching Bonus:** A multi-generational bonus paid on the *Network Bonus* earnings of a member's downline, extending up to four generations.1 This feature has a critical technical nuance: the depth (number of generations) and percentage (10%, 10%, 20%, 25%) are *package-dependent*.1 The software must be able to dynamically link a member's compensation-plan eligibility to their purchased "package" (e.g., "Tycoon Trader").1

### **2.3 Critical Wallet & Tokenomic Architecture**

These features are the most complex, high-risk, and non-standard elements of the project. Their implementation will require significant custom development.

* **Feature: The 60/40 Split E-Wallet:**  
  * **Specification:** "60% of these payments \[all bonuses\] will go to your cash account, 40% will fund your mandatory account.".1  
  * **Technical Translation:** This is a hard-coded, non-optional rule applied to *all* calculated bonus payouts. The platform's e-wallet system cannot be a single ledger. It must be a "split wallet" or "multi-wallet" 11 architecture, programmatically dividing all incoming funds into two distinct ledgers:  
    1. **"Cash Account" (60%):** A standard, liquid e-wallet. This ledger holds withdrawable funds that can be sent to external payment gateways 1 or used for other platform-related purchases.  
    2. **"Mandatory Account" (40%):** A non-liquid, restricted-use ledger. This is an advanced implementation of what the MLM industry terms a "Repurchase Wallet".12 Its funds are not withdrawable. The *sole purpose* of this account within the OneCoin ecosystem is to create forced, artificial demand for the native token by acting as a pool of capital that can *only* be used to purchase FCO tokens (as "OneToken") from the internal exchange.  
* **Feature: The "Token Split" (Account Doubling):**  
  * **Specification:** "...once a number of new members is reached we SPLIT your Tokens. This means we double the amount on your account\!".1  
  * **Technical Translation:** This is the most complex custom feature. This is *not* a bonus calculation or a commission. It is a platform-wide, event-driven **asset-doubling mechanic** that fundamentally alters the token ledger.  
  * The trigger is described as "once a number of new members is reached" 1, which confirms this is a centralized, administrator-controlled event, not a decentralized, algorithmic one.  
  * The software must, therefore, have a custom-built "Token Management" module in the admin backend. This module must contain a function (e.g., "Trigger Token Split") that, when executed by a privileged administrator, iterates through all user accounts holding the FCO token and executes a database transaction to multiply their balance by two. This feature, more than any other, dictates the need for a highly extensible, on-premise platform with a modular architecture 7, as no off-the-shelf product will ever include this function.

### **2.4 Ancillary Bonus & Platform Systems**

* **Native Token (FCO):** The system must be built around the native FCO token, which replaces "OneToken".1 This token is the central asset that is purchased (with the "Mandatory Account"), held, and "split." The platform must have a robust internal ledger to manage this private asset.14  
* **Secondary Bonus Asset:** The "Aurum Gold Coins" (AGC) 1 are a *second, distinct asset* given "FREE" with package purchases. This requires the platform to support *multiple, distinct token ledgers*—one for FCO and one for this secondary "Gold" token.  
* **Points System:** The "OneLife Points Bonus" 1 is a conventional, accumulative loyalty-point system based on network size and tenure. This is a common feature in enterprise-grade MLM platforms.  
* **Rank Advancement:** The "Recognition Rewards" (Sapphire, Ruby, Diamond, etc.) 1 are triggered by cumulative "Weaker Leg Volume." This is a standard "Rank" or "Leadership" module that automates promotions based on performance metrics.  
* **Support Systems:**  
  * **KYC Integration:** The OneCoin model explicitly mentions KYC (Know Your Customer) procedures.1 The platform must have a built-in KYC module or a robust API to integrate a third-party verification service.14  
  * **Payment Card Integration:** The "ONECARD" 1 implies the "Cash Account" e-wallet must have API-level integration with a third-party debit card issuer (e.g., Marqeta, Stripe Issuing) to allow users to spend their cash balances.

### **2.5 Table: Benchmark Feature Requirement Set**

The following table synthesizes this analysis into a master scorecard. This benchmark will be used to evaluate all prospective software solutions. The "Est. Customization" column estimates the development effort required (Low, Medium, High, Very High) to implement the feature, assuming a standard COTS platform as the base.

**Table 2.1: Benchmark Feature Requirement Set (OneCoin Model)**

| Feature Category | Specific Requirement | Source | Criticality | Est. Customization |
| :---- | :---- | :---- | :---- | :---- |
| **Core Plan** | Binary Bonus (10% weaker leg) | p. 28 | Critical | Low |
| **Core Plan** | Direct Sales Bonus (10% BV) | p. 28 | Critical | Low |
| **Core Plan** | Matching Bonus (4-gen, package-based) | p. 29 | Critical | Medium |
| **Core Plan** | Rank Advancement (Volume-based) | p. 36-37 | High | Medium |
| **Wallet System** | **60/40 Split Wallet (Cash/Mandatory)** | **p. 28** | **Critical** | **High** |
| **Wallet System** | E-Wallet Payout Card Integration | p. 45 | Medium | Medium |
| **Tokenomics** | Native Token (FCO) as main asset | (User Query) | Critical | High |
| **Tokenomics** | **"Token Split" (Account Doubling)** | **p. 35** | **Critical** | **Very High** |
| **Tokenomics** | Secondary Bonus Asset (e.g., "Gold") | p. 40-41 | Medium | High |
| **Bonus System** | Start-Up Bonus (Time-based) | p. 34 | Low | Low |
| **Bonus System** | Points System (Loyalty) | p. 38-39 | Low | Medium |
| **Platform** | On-Premise / Self-Hosted | (User Query) | Critical | N/A (Filter) |
| **Platform** | KYC Integration Module | p. 9 | High | Medium |

## **3.0 Analysis of Open-Source (OSS) Self-Hosted Solutions**

### **3.1 Overview**

This section assesses the feasibility of utilizing free and open-source software (FOSS) to meet the Benchmark Feature Requirement Set defined in Section 2.0. The analysis focuses on technical viability, scalability, security, and the total cost of ownership (TCO) associated with the required, extensive customization.

### **3.2 Open-Source Landscape**

The FOSS landscape for enterprise-grade MLM software is extremely sparse.16 A review of public repositories on GitHub and platforms like SourceForge 17 indicates that available solutions fall into two distinct categories:

1. **Basic, Procedural Scripts:** A large number of simplistic projects, typically written in PHP/MySQL, designed as educational tools or for very small-scale operations.2  
2. **Extensible Frameworks:** A very small, niche group of platforms built as true, modular frameworks designed for extension.

### **3.3 Option 1: Basic Scripts (e.g., santosh3700/MLM-Website-Using-PHP)**

This project 2 is a representative example of the first category. It is explicitly described as a "MLM Project created using PHP" for a YouTube tutorial series.2

* **Analysis:** The software supports a basic Binary plan and provides a database-import file (mlm.sql) for self-hosting.2 However, it lacks any of the foundational architectural components required for the target project. Analysis confirms it has no e-wallet module, no token-management module, no KYC integration, and no modular structure for adding new compensation types.2  
* **Feasibility:** **Nil.** This type of software is a learning tool, not an enterprise platform. It lacks the basic security, scalability, and modularity (e.g., e-wallets, token ledgers) to even begin the customizations required by the OneCoin benchmark. Attempting to build upon this base would be a complete rewrite.

### **3.4 Option 2: Extensible Framework (genelet/mlm)**

This is the only credible, framework-based FOSS candidate identified in the research.19 It is described as a "fully featured open-source Multi-Level Market (MLM) package" 5 built on a parent framework named "Genelet".4

* **Analysis:**  
  * **Technology:** The entire framework is written in the **Perl** programming language.5  
  * **Extensibility:** The platform is explicitly designed for extension. The documentation states "developer can easily extend it to other customized plans".5 It even provides a high-level guide for adding a new compensation plan, which involves adding new columns to the database and creating new action programs in the lib/MLM/Income directory.4  
  * **Features:** It claims to provide core modules for "registration, membership, compensations, cronjobs, shopping, ticketing, backend administration" 5 and natively supports unilevel, team, pairing (Binary), and affiliate bonuses.5

### **3.5 The "Perl Problem" and the Viability of genelet/mlm**

While genelet/mlm 5 is architecturally sound in theory, its foundation in Perl presents a critical, likely insurmountable, business and technical risk.

Perl, while a powerful language, is a niche, legacy technology for modern web application development.20 Finding, vetting, and retaining expert-level Perl developers to work on a niche, sparsely documented framework 4 would be exceptionally difficult and costly.

Because *all* of the critical, high-difficulty features from the benchmark table—including the 60/40 Split Wallet, the "Token Split" mechanic, the secondary asset ledger, and the KYC module—would need to be **custom-built from scratch in Perl** 21, the FOSS path becomes a trap.

The total cost of ownership (TCO) for this approach, factoring in the cost of specialist developers and the extended time-to-market, would almost certainly be *higher* than procuring a commercial license. The extreme development cost, high project risk, and long-term maintenance burden make the genelet/mlm path an unviable strategy for an enterprise-grade FinTech project.

### **3.6 Comparative Table: Open-Source Solutions**

**Table 3.1: Comparative Analysis of Open-Source Solutions**

| Software | Source Link | Technology | Core Plan | Extensible? | Feasibility for OneCoin Model |
| :---- | :---- | :---- | :---- | :---- | :---- |
| **Basic PHP Scripts** | 2 | PHP, MySQL | Binary | No | **Nil.** Lacks all critical features (e-wallet, token ledger, security, scalability). |
| **genelet/mlm** | 4 | Perl, MySQL | Binary (Pairing) | **Yes.** 4 | **Not Recommended.** Requires building all critical FinTech features (Split Wallet, Token Split, KYC) from scratch in Perl, leading to extreme cost, risk, and maintenance burden. |

## **4.0 Analysis of Commercial (COTS) On-Premise Solutions**

### **4.1 Overview**

The commercial (COTS) market provides the only realistic path to achieving the project's goals. The key differentiator among vendors is *not* their out-of-the-box feature list, as none will match the benchmark. The critical differentiator is **architectural extensibility** and a vendor's proven ability to deliver:

1. A stable, scalable **on-premise deployment** option.7  
2. A **robust customization service** capable of building the complex, non-standard FinTech modules required.8

### **4.2 The "Customization" Business Model**

The enterprise MLM software market operates on a "platform \+ customization" model. Vendors provide a core engine, and their primary revenue stream is the professional services (custom development) required to tailor that engine to a client's complex compensation plan.8 "Compensation Plan Complexity" is noted as a primary driver of cost.24

The OneCoin model (Table 2.1) represents an "extremely high" complexity. The total project cost will be the sum of the (One-Time License Fee) \+ (Customization Fee), and the customization fee will likely represent the majority of the investment. The goal of this analysis is to find the vendor with the *best base platform* to build upon, minimizing the cost and risk of that customization.

---

### **4.3 Vendor Profile: Infinite MLM Software**

* **Sources:** 7  
* **On-Premise:** **Yes (Confirmed).** The vendor explicitly offers "On Premises" deployment as an alternative to their cloud solution.7 Independent reviews on GoodFirms also confirm "On Premises" as a licensing model.34  
* **Binary Plan:** **Yes (Confirmed).** The Binary plan is a core supported feature.9  
* **60/40 Split Wallet:** **High Feasibility.** While this specific 60/40 split is not a standard feature 26, the platform's e-wallet is designed to be "customized".26 Critically, a blog post from the company explicitly discusses the concept of a "**Repurchase Wallet**" 12—the precise industry term for the "mandatory account" required by the OneCoin plan. This confirms the vendor understands the *concept* of a restricted, non-withdrawable wallet, making the 60/40 split a straightforward (though custom) configuration.  
* **"Token Split" Mechanic:** **High Feasibility.** This feature is not standard.9 However, the platform is exceptionally well-aligned for this customization. The feature list explicitly includes "**Tokenomics & Plan Support**" 14 and support for "your **custom token**".14 The company's marketing and blog posts are heavily focused on their enterprise *customization capabilities*.8 This is the ideal combination: a platform that already has a modular "custom token" architecture 14 and a business model built on delivering complex, custom FinTech logic.8  
* **Ancillary Features:**  
  * **KYC:** **Yes (Confirmed).** The platform includes a "**KYC/AML Integration**" module.14  
  * **Multi-Asset:** **High Feasibility.** The "E-Wallet" 27 and "Tokenomics" 14 modules provide the necessary foundation to support both the FCO token and the secondary "Gold" bonus token.  
* **Pros:**  
  * Explicitly supports on-premise deployment.34  
  * Strongest evidence of a pre-built, modular architecture for *custom tokenomics*.14  
  * Natively supports critical ancillary features like KYC.14  
  * Demonstrates understanding of the "Repurchase Wallet" 12 concept.  
* **Cons:**  
  * As a high-end, customization-focused platform, customization costs will be significant.  
* **Source Link:** https://infinitemlmsoftware.com/ 9

---

### **4.4 Vendor Profile: Neo MLM Software**

* **Sources:** 10  
* **On-Premise:** **Yes (Confirmed).** This vendor *explicitly* advertises "On-Premises MLM Software," describing it as a "one-time licensing fee" model.22 This is a perfect match for the project's deployment requirement.  
* **Binary Plan:** **Yes (Specialty).** The platform is highlighted as being "Best for binary MLM plans".35 This is a core competency.  
* **60/40 Split Wallet:** **Medium Feasibility.** The platform includes standard "E-wallet and Payment Integration".10 However, unlike Infinite, there is no public-facing documentation referencing "repurchase wallets." This feature would need to be custom-built, and its feasibility would need to be confirmed.  
* **"Token Split" Mechanic:** **Medium Feasibility.** This feature is not documented.10 The platform supports "Bitcoin MLM Software" and "Cryptocurrency MLM Plan Software" 10, so the vendor is active in the crypto space. However, they lack the specific "custom tokenomics" language seen from Infinite 14, making this a higher-risk customization.  
* **Ancillary Features:** Not explicitly detailed, but the on-premise model implies customization is the intended path.22  
* **Pros:**  
  * Explicitly and clearly offers an on-premise, licensed deployment model.22  
  * Specializes in the required Binary compensation plan.35  
* **Cons:**  
  * Less documented evidence of deep, modular *tokenomic* customization (like "Token Splits" or "Repurchase Wallets") compared to Infinite.  
* **Source Link:** https://neomlmsoftware.com/ 10

---

### **4.5 Vendor Profile: ARM MLM**

* **Sources:** 36  
* **On-Premise:** **Implied (High Risk).** The vendor's pricing "buy MLM Software for just $799" 36 strongly implies a one-time license purchase typical of on-premise software, but it is not explicitly confirmed as a deployment model.  
* **Binary Plan:** **Yes (Confirmed).** The Binary plan is a core supported feature.36  
* **60/40 Split Wallet:** **Medium Feasibility.** The platform has a "Dynamic Wallet System" 36, but no explicit support for split or repurchase wallets. This would be a custom build.  
* **"Token Split" Mechanic:** **Medium Feasibility.** This feature is not standard.36 However, the platform *does* offer a "**Token Sale with a Referral Program**" add-on.36 This is a promising sign, as it indicates a modular, token-aware architecture that could potentially be extended.  
* **Key Risk \- "Bait-and-Switch":** The advertised $799 price 36 is a major red flag. This price is for a bare-bones, base-level system. The OneCoin benchmark (Table 2.1) represents an enormously complex and high-cost project.24 The vendor likely uses the low $799 price as a "bait" to attract clients, who are then "switched" to an exorbitant customization fee to build the features they *actually* need. This vendor represents a significant procurement risk.  
* **Pros:**  
  * Has a "Token Sale" add-on 36, suggesting token-based architecture.  
* **Cons:**  
  * The low-ball $799 price 36 is a significant red flag for a "bait-and-switch" model, which is antithetical to a high-cost enterprise project.  
  * On-premise deployment is not explicitly confirmed.  
* **Source Link:** https://www.armmlm.com/ 36

---

### **4.6 Vendor Profile: Epixel MLM Software**

* **Sources:** 11  
* **On-Premise:** **No (Unclear/Risky).** This vendor is a critical failure against the project's mandatory requirements. Analysis *could not confirm* an on-premise option.38 The platform is described as "Cloud-native" 38, and the pricing page was inaccessible.44 While 41 *implies* it by listing "Linux, macOS, Windows," all evidence points to this being a SaaS (Software-as-a-Service) solution.  
* **Binary Plan:** Yes.38  
* **Customization:** The platform appears highly extensible, with "Customized compensation configuration" 11 and "Multi-wallet configuration".11  
* **Conclusion:** **Disqualified.** Despite being a high-end platform 38, its "Cloud-native" 38 architecture fails to meet the project's *mandatory* "on-premise / self-hosted" requirement.

---

### **4.7 Vendor Profile: Blockchain-Centric Developers (Nadcab, Blockchain App Factory)**

* **Sources:** 45  
* **Analysis:** This represents an alternative *path*: full custom development, not a COTS product. These vendors 45 are "Blockchain App" developers, not MLM software providers.  
* **On-Premise:** **No (Architectural Mismatch).** This path presents a fundamental architectural contradiction. These firms specialize in building *decentralized* "smart contract MLM software" 45 that runs on a public blockchain (like Ethereum, Tron, etc.). The project's core requirement is a *centralized* "on-site server" (on-premise).  
* **Conclusion:** **Disqualified.** This is an architectural mismatch. The project requires a centralized, private system. These vendors sell the diametric opposite: a decentralized, public system. Engaging them would not meet the core technical and business requirements.

## **5.0 Feasibility Analysis & Comparative Summary**

### **5.1 Overview**

This section synthesizes the vendor analysis to provide a final comparative-gap analysis. It focuses on the implementation path for the two most critical and complex custom features: the "60/40 Split Wallet" and the "Token Split" mechanic.

### **5.2 Feasibility of "60/40 Split Wallet" (Mandatory Account)**

The implementation of the 60/40 bonus split 1 is a customization, but it is built upon a known and established industry concept.

* **Analysis:** The "mandatory account" is functionally identical to a "**Repurchase Wallet**".12 This is a feature used in many MLM platforms to force members to use a portion of their earnings to buy more products, thus generating consistent sales volume.12  
* **Implementation:** Any enterprise vendor (like Infinite MLM, which explicitly understands the "Repurchase Wallet" concept 12) can achieve this. The custom development would involve:  
  1. Configuring the commission engine to automatically divert 40% of *all* bonus payouts to this dedicated wallet ledger.  
  2. Restricting the "spend" functionality of this wallet so that its funds can *only* be used for one action: purchasing FCO tokens from the platform's internal exchange/module.  
* **Feasibility:** **High.** This is a common-enough concept in the MLM industry that high-end vendors can customize it with relative ease.

### **5.3 Feasibility of "Token Split" (Account Doubling)**

This is the project's critical, high-risk, and entirely custom feature.1 As established in the architectural recommendation (Section 1.4), this feature is only pragmatically feasible if the FCO token is an **internal, private ledger** (i.e., a database table).

* **Implementation:** The on-premise software's database would require a new, custom table (e.g., fco\_ledger) that maps user\_id to fco\_balance. The customization project would then involve building:  
  1. A new **Admin-side "Tokenomics" Module** in the backend.  
  2. A secure, permission-gated button in this module labeled "Trigger Token Split."  
  3. A **Trigger Function** that, when executed, runs a database transaction similar to: UPDATE fco\_ledger SET fco\_balance \= fco\_balance \* 2;  
  4. A comprehensive **Audit Log** to immutably record when this platform-wide event was triggered and by which administrator.

This centralized, database-driven approach is further validated by the history of the *actual* OneCoin. A 2019 complaint from the U.S. Department of Justice alleged that "OneCoins are not mined... but instead are automatically generated through software".49 This strongly suggests the original OneCoin software (which this project seeks to replicate) was, in fact, a centralized SQL database where "coins" were created by administrative fiat, not a true blockchain.

This confirms that the recommended centralized architecture is the correct and most authentic way to replicate the *function* of the OneCoin plan.

* **Feasibility:** **Medium-to-High (with the right vendor).** This requires a platform that is architected for modularity—allowing a new admin module to be "plugged in" and allowing that module to execute core database transactions. Vendors like Infinite MLM, which already have "Custom Token" 14 and "Tokenomics" 14 modules, are the lowest-risk partners for this custom build.

### **5.4 Master Comparison Table: Commercial On-Premise Solutions**

The following table provides the final, at-a-glance summary for procurement. It evaluates the top candidates against the project's most critical and difficult requirements.

**Table 5.1: Commercial On-Premise Solutions: Feature-Gap & Customization Feasibility**

| Vendor | Source Link | On-Premise? | Binary Plan? | Feasibility: 60/40 Split Wallet | Feasibility: "Token Split" | Key Insight |
| :---- | :---- | :---- | :---- | :---- | :---- | :---- |
| **Infinite MLM** | 9 | **Yes (Confirmed)** 34 | **Yes** 9 | **High.** (Vendor explicitly references the "Repurchase Wallet" concept 12). | **High.** (Platform has "Custom Token" 14 & "Tokenomics" 14 modules. Heavy focus on customization 8). | **Top Candidate.** Platform is pre-built for custom crypto/token integration. |
| **Neo MLM** | 10 | **Yes (Confirmed)** 22 | **Yes (Specialty)** 35 | **Medium.** (Would be a custom e-wallet build. No pre-existing "repurchase" concept found 10). | **Medium.** (Platform supports crypto 10 but lacks the specific "Tokenomics" module language of Infinite). | **Strong Candidate.** Clear on-premise license model.22 Binary plan is their core strength.35 |
| **ARM MLM** | 36 | **Yes (Implied)** 36 | **Yes** 36 | **Medium.** (Has "Token Sale" add-on 36, so e-wallet customization is likely). | **Medium.** (Token add-on 4 is a good sign, but base platform may be too simple). | **High Risk.** The $799 price 36 is a "bait-and-switch" red flag. Customization will be extremely expensive. |
| **Epixel MLM** | 38 | **No (Unclear)** 38 | **Yes** 39 | **Medium.**.11 | **Medium.**.11 | **Disqualified.** Fails the *mandatory* "on-premise" requirement. Platform is "Cloud-native".38 |
| **Nadcab Labs** | 47 | **No (Mismatch)** 47 | **Yes** 47 | **High.** (It's a full custom build). | **High.** (It's a full custom build). | **Disqualified.** Architectural mismatch. Sells *decentralized* smart contracts 47, not *centralized* on-premise software. |

## **6.0 Strategic Recommendations and Implementation Roadmap**

### **6.1 Final Recommendation**

The project must proceed by procuring an **on-premise, enterprise-grade license** from a COTS vendor and simultaneously scoping a **comprehensive, fixed-bid customization package** to implement the non-standard OneCoin tokenomic features.

* **Primary Candidate:** **Infinite MLM Software.** This vendor provides the most robust, pre-built foundation for the project. They offer:  
  1. Confirmed on-premise deployment.34  
  2. Explicit modules for "Custom Token" 14 and "Tokenomics".14  
  3. A built-in "KYC/AML" module.14  
  4. Documented understanding of the "Repurchase Wallet" 12 concept, which is the key to the 60/40 split.  
* **Secondary Candidate:** **Neo MLM Software.** This vendor is a strong backup, offering:  
  1. The clearest on-premise, one-time-fee licensing model.22  
  2. A core specialty in the required Binary plan.35  
  * The procurement process for this vendor must heavily focus on their technical ability to deliver the custom token-related modules, as this is less documented.

### **6.2 Recommended Implementation Roadmap & Next Steps**

1. **Finalize Architecture:** The first step is to formally ratify the architectural decision (Section 1.4) to implement the FCO token as a **centralized, private-ledger** asset on the on-premise server. This decision is critical and must be finalized *before* contacting vendors.  
2. **Vendor Engagement:** Initiate contact with the sales and technical teams at **Infinite MLM Software** 32 and **Neo MLM Software**.10 The project's nature requires bypassing low-level sales and engaging directly with technical architects or senior solution engineers.  
3. **Submit Formal Procurement RFI:** Do not request a generic "demo" or "quote." A formal Request for Information (RFI) must be sent that includes the **Benchmark Feature Requirement Set** (Table 2.1). This RFI *must* ask for a specific feasibility analysis, ballpark cost, and estimated timeline for two line items:  
   * *Item 1: "A 60/40 Split E-Wallet Module,"* with 40% of all bonuses routed to a "Mandatory" wallet.  
   * *Item 2: "A Custom Tokenomics Module,"* to manage an internal token ledger and include an admin-triggered "Token Split" (Account Doubling) event.  
4. **Evaluate Responses:** The deciding factor will be the quality and confidence of their answers to these *two specific items*. A vendor who is confused by the request or attempts to pivot to a different model is not a viable partner. A vendor who says "Yes, we can build that; it is a high-level customization" 8 is a candidate.  
5. **Budgeting:** Plan for the custom development costs to *significantly exceed* the base software license fee. The primary cost of this project is in the custom-built FinTech logic, not the standard MLM engine.24

### **6.3 Concluding Architectural Insight**

It is essential to understand that this project is not merely the procurement of MLM software. It is the development of a **private, closed-loop financial ecosystem** that uses a tokenized internal asset (FCO). The OneCoin model 1 is designed to create perceived value through engineered scarcity (the 40% "mandatory" buy-in) and programmed "growth" (the "Token Split").

The software to run this must be a hybrid: a robust, scalable **MLM compensation engine** (to calculate the bonuses) bolted to a **custom-built, centralized token-treasury system** (to manage the FCO tokenomics). The selected COTS platform will only provide the former; the true success of the project depends entirely on the vendor's proven ability to custom-build the latter.

#### **Works cited**

1. one-coin-compensation-plan.pdf  
2. GitHub \- GitHub, accessed on November 16, 2025, [https://github.com/santosh3700/MLM-Website-Using-PHP-Binary-Plan-Version-1.0](https://github.com/santosh3700/MLM-Website-Using-PHP-Binary-Plan-Version-1.0)  
3. adilk121/binary-tree-mlm \- GitHub, accessed on November 16, 2025, [https://github.com/adilk121/binary-tree-mlm](https://github.com/adilk121/binary-tree-mlm)  
4. genelet/mlm: Comprehensive open-source Multi-Level Marketing (MLM) Software \- GitHub, accessed on November 16, 2025, [https://github.com/genelet/mlm](https://github.com/genelet/mlm)  
5. bogwero/mlm-manager-full: Fully Featured Multi-Level-Marketing Software \- GitHub, accessed on November 16, 2025, [https://github.com/bogwero/mlm-manager-full](https://github.com/bogwero/mlm-manager-full)  
6. Cloud-Based vs On-Premise MLM Software: What To Choose? \- Webcom Systems, accessed on November 16, 2025, [https://webcomsystem.net/blog/cloud-based-vs-on-premise-mlm-software/](https://webcomsystem.net/blog/cloud-based-vs-on-premise-mlm-software/)  
7. Cloud-Based MLM Software vs. On-Premise: What's Best in 2025?, accessed on November 16, 2025, [https://infinitemlmsoftware.com/blog/cloud-based-mlm-software-vs-on-premise/](https://infinitemlmsoftware.com/blog/cloud-based-mlm-software-vs-on-premise/)  
8. Must-Have Enterprise MLM Software Customizations, accessed on November 16, 2025, [https://infinitemlmsoftware.com/blog/enterprise-mlm-software-customizations/](https://infinitemlmsoftware.com/blog/enterprise-mlm-software-customizations/)  
9. Infinite MLM Software, accessed on November 16, 2025, [https://infinitemlmsoftware.com/](https://infinitemlmsoftware.com/)  
10. MLM Software: Best Multi Level Network Marketing Software, accessed on November 16, 2025, [https://neomlmsoftware.com/](https://neomlmsoftware.com/)  
11. Cryptocurrency Trading MLM Software from Team Epixel, accessed on November 16, 2025, [https://www.epixelmlmsoftware.com/cryptocurrency-trading-mlm-software](https://www.epixelmlmsoftware.com/cryptocurrency-trading-mlm-software)  
12. The Financial Engine of Network Marketing: E-Wallet in MLM Software, accessed on November 16, 2025, [https://infinitemlmsoftware.com/blog/e-wallet-in-mlm-software/](https://infinitemlmsoftware.com/blog/e-wallet-in-mlm-software/)  
13. Matrix MLM software developement company India, ladder plan, pyramid scheme software, accessed on November 16, 2025, [https://www.dngwebdeveloper.com/matrix-mlm-software](https://www.dngwebdeveloper.com/matrix-mlm-software)  
14. Secure MLM Platform for Crypto Investment Networks \- Infinite MLM Software, accessed on November 16, 2025, [https://infinitemlmsoftware.com/industries/crypto-investment-network/](https://infinitemlmsoftware.com/industries/crypto-investment-network/)  
15. MLM Modules \- Hybrid MLM Software, accessed on November 16, 2025, [https://www.hybridmlm.io/mlm-software-modules/](https://www.hybridmlm.io/mlm-software-modules/)  
16. awesome-selfhosted/awesome-selfhosted: A list of Free Software network services and web applications which can be hosted on your own servers \- GitHub, accessed on November 16, 2025, [https://github.com/awesome-selfhosted/awesome-selfhosted](https://github.com/awesome-selfhosted/awesome-selfhosted)  
17. Best MLM Software for Startups of 2025 \- Reviews & Comparison \- SourceForge, accessed on November 16, 2025, [https://sourceforge.net/software/mlm/for-startup/](https://sourceforge.net/software/mlm/for-startup/)  
18. SaxoBeatMos/mlm-tree: mlm dynamic binary tree code in PHP and MySQL \- GitHub, accessed on November 16, 2025, [https://github.com/SaxoBeatMos/mlm-tree](https://github.com/SaxoBeatMos/mlm-tree)  
19. multilevel-marketing · GitHub Topics, accessed on November 16, 2025, [https://github.com/topics/multilevel-marketing?l=perl](https://github.com/topics/multilevel-marketing?l=perl)  
20. Perl web framework \- Catalyst \- www.perl.org, accessed on November 16, 2025, [https://www.perl.org/about/whitepapers/perl-webframework.html](https://www.perl.org/about/whitepapers/perl-webframework.html)  
21. How do you use SHA256 to create a token of key,value pairs and a secret signature?, accessed on November 16, 2025, [https://stackoverflow.com/questions/8830398/how-do-you-use-sha256-to-create-a-token-of-key-value-pairs-and-a-secret-signatu](https://stackoverflow.com/questions/8830398/how-do-you-use-sha256-to-create-a-token-of-key-value-pairs-and-a-secret-signatu)  
22. MLM Software Pricing: Price List for All Network Marketing Software, accessed on November 16, 2025, [https://neomlmsoftware.com/mlm-pricing/](https://neomlmsoftware.com/mlm-pricing/)  
23. Why Customizable MLM Software is Essential for Your Network Marketing Business?, accessed on November 16, 2025, [https://infinitemlmsoftware.com/blog/custom-mlm-software/](https://infinitemlmsoftware.com/blog/custom-mlm-software/)  
24. MLM Software Pricing: A Complete Guide for 2025, accessed on November 16, 2025, [https://securemlmsoftware.com/mlm-software-pricing-guide/](https://securemlmsoftware.com/mlm-software-pricing-guide/)  
25. Choosing the Top MLM Software: A Comparison of Best Options, accessed on November 16, 2025, [https://infinitemlmsoftware.com/blog/comparing-the-top-mlm-software/](https://infinitemlmsoftware.com/blog/comparing-the-top-mlm-software/)  
26. MLM E-Wallet \- Digital Wallet | Infinite MLM Add-On, accessed on November 16, 2025, [https://infinitemlmsoftware.com/e-wallet.php](https://infinitemlmsoftware.com/e-wallet.php)  
27. Must have MLM Software Features for MLM Business success, accessed on November 16, 2025, [https://infinitemlmsoftware.com/features.php](https://infinitemlmsoftware.com/features.php)  
28. Types of MLM Bonuses and Commission Structures \- Infinite MLM Software, accessed on November 16, 2025, [https://infinitemlmsoftware.com/blog/types-of-mlm-bonuses/](https://infinitemlmsoftware.com/blog/types-of-mlm-bonuses/)  
29. MLM Payout Automation: Simplify Your Payout Process \- Infinite MLM Software, accessed on November 16, 2025, [https://infinitemlmsoftware.com/blog/mlm-payout-automation-simplify-payout-process/](https://infinitemlmsoftware.com/blog/mlm-payout-automation-simplify-payout-process/)  
30. Integrate Cryptocurrency MLM Payments for MLM Business \- Infinite MLM Software, accessed on November 16, 2025, [https://infinitemlmsoftware.com/blog/integrate-cryptocurrency-mlm-payments/](https://infinitemlmsoftware.com/blog/integrate-cryptocurrency-mlm-payments/)  
31. Crypto-Based MLM Businesses: Features You Can't Ignore in 2025, accessed on November 16, 2025, [https://infinitemlmsoftware.com/blog/crypto-based-mlm-businesses-features/](https://infinitemlmsoftware.com/blog/crypto-based-mlm-businesses-features/)  
32. Contact Us \- Infinite MLM Software, accessed on November 16, 2025, [https://infinitemlmsoftware.com/contact-us.php](https://infinitemlmsoftware.com/contact-us.php)  
33. Infinite MLM Software Reviews & Product Details \- G2, accessed on November 16, 2025, [https://www.g2.com/products/infinite-mlm-software/reviews](https://www.g2.com/products/infinite-mlm-software/reviews)  
34. Infinite MLM Software Reviews & Pricing 2025 \- GoodFirms, accessed on November 16, 2025, [https://www.goodfirms.co/software/infinite-mlm-software](https://www.goodfirms.co/software/infinite-mlm-software)  
35. 25 Best Multi-Level Marketing (MLM) Software In 2025 \- The CMO, accessed on November 16, 2025, [https://thecmo.com/tools/best-mlm-software/](https://thecmo.com/tools/best-mlm-software/)  
36. \#1 MLM Software: Best for Automation & Commission Tracking, accessed on November 16, 2025, [https://www.armmlm.com/](https://www.armmlm.com/)  
37. Binary MLM Software for Effective MLM Compensation Plan, accessed on November 16, 2025, [https://www.armmlm.com/binary-mlm-compensation-plan/](https://www.armmlm.com/binary-mlm-compensation-plan/)  
38. Epixel MLM Software | Best Network Marketing Growth Tools, accessed on November 16, 2025, [https://www.epixelmlmsoftware.com/](https://www.epixelmlmsoftware.com/)  
39. Binary MLM Software for Binary MLM Compensation Plan \- Epixel MLM Software, accessed on November 16, 2025, [https://www.epixelmlmsoftware.com/binary-plan-mlm-software](https://www.epixelmlmsoftware.com/binary-plan-mlm-software)  
40. Version History \- Latest Version, Integrations, and Feature Updates \- Epixel MLM Software, accessed on November 16, 2025, [https://www.epixelmlmsoftware.com/version-history](https://www.epixelmlmsoftware.com/version-history)  
41. Emgoldex MLM Software Free Demo | Table Split Compensation Plan, accessed on November 16, 2025, [https://www.epixelmlmsoftware.com/emgoldex-mlm-table-plan](https://www.epixelmlmsoftware.com/emgoldex-mlm-table-plan)  
42. MLM E-Wallet for faster and secure MLM transactions \- Epixel MLM Software, accessed on November 16, 2025, [https://www.epixelmlmsoftware.com/e-wallet-for-mlm](https://www.epixelmlmsoftware.com/e-wallet-for-mlm)  
43. Epixel MLM Software Features, accessed on November 16, 2025, [https://www.epixelmlmsoftware.com/mlm-software-features](https://www.epixelmlmsoftware.com/mlm-software-features)  
44. accessed on January 1, 1970, [https://www.epixelmlmsoftware.com/mlm-software-pricing](https://www.epixelmlmsoftware.com/mlm-software-pricing)  
45. Smart Contract MLM Software Development Company, accessed on November 16, 2025, [https://www.blockchainappfactory.com/smart-contract-mlm-software](https://www.blockchainappfactory.com/smart-contract-mlm-software)  
46. Launch MLM System Using Your Own Blockchain Token \- Nadcab Labs, accessed on November 16, 2025, [https://www.nadcab.com/blog/how-to-launch-mlm-with-my-token](https://www.nadcab.com/blog/how-to-launch-mlm-with-my-token)  
47. Cryptocurrency MLM Software Development Company | Nadcab Labs, accessed on November 16, 2025, [https://www.nadcab.com/cryptocurrency-mlm-software](https://www.nadcab.com/cryptocurrency-mlm-software)  
48. Explore Key Features of MLM Smart Contracts with Nadcab Labs, accessed on November 16, 2025, [https://www.nadcab.com/blog/essential-features-of-mlm-smart-contracts](https://www.nadcab.com/blog/essential-features-of-mlm-smart-contracts)  
49. NICHOLAS FOLLY Assistant United States Attorneys, accessed on November 16, 2025, [https://www.justice.gov/d9/press-releases/attachments/2019/03/08/u.s.\_v.\_konstantin\_ignatov\_complaint\_0.pdf](https://www.justice.gov/d9/press-releases/attachments/2019/03/08/u.s._v._konstantin_ignatov_complaint_0.pdf)