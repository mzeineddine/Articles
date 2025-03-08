<?php
    $base = "..";
    require $base . "/connections/connection.php";
    function store_user($email,$pass,$user_name,$conn){
        $query = $conn->prepare("INSERT INTO users (email, pass, user_name) VALUES (?,?,?);");
        sql_utils::query_execution($query,"sss", [$email,$pass,$user_name]);
    }

    function store_question($question,$answer,$conn){
        $query = $conn->prepare("INSERT INTO users (question,answer) VALUES (?,?);");
        sql_utils::query_execution($query,"ss", [$question,$answer]);
    }

    store_question(" What is technical debt in the context of machine learning (ML) systems?",
                            "Technical debt in ML systems refers to the long-term costs and maintenance burdens caused by short-term solutions, quick fixes, or suboptimal practices during system development.",$conn);
    store_question("Why do ML systems accumulate more technical debt than traditional software systems?",
                    "ML systems not only inherit the technical debt of traditional software but also face unique challenges such as data dependencies, model entanglement, and feedback loops.",$conn);
    store_question("What is the CACE Principle in ML systems?",
                    "CACE stands for 'Changing Anything Changes Everything' highlighting how modifying a single input or feature can impact the entire ML model and related components.",$conn);
    store_question("How does entanglement contribute to technical debt in ML systems?",
                    "Entanglement occurs when ML models mix input signals, making it difficult to isolate the impact of changes to specific features or parameters.", $conn);
    store_question("What are Correction Cascades, and why are they problematic?",
            'Correction cascades arise when a model is used as input to another model, creating dependencies that make system-wide improvements difficult and can lead to "improvement deadlock."',$conn);
    store_question(" What are 'Undeclared Consumers' in an ML system?",
                    "Undeclared consumers are components that use the output of a model without being explicitly documented, potentially leading to hidden feedback loops and unpredictable behavior.",$conn);
    store_question("Why are data dependencies more challenging than code dependencies in ML systems?",
                    "Data dependencies are harder to track and manage because they can change dynamically over time, often without clear documentation or monitoring.",$conn);
    store_question("What is an 'Unstable Data Dependency'?",
                    "Unstable data dependencies involve input signals that change behavior (qualitatively or quantitatively) over time, which can destabilize model performance.",$conn);
    store_question("How do 'Underutilized Data Dependencies' increase technical debt?",
                    "They add complexity and make the system vulnerable to change without providing significant modeling benefits, often leading to unnecessary maintenance work.",$conn);
    store_question("What is 'Glue Code' in ML systems?",
                    "Glue code is the auxiliary code written to connect ML models with other system components. It often becomes a maintenance burden as it locks the system into specific models or packages.",$conn);
    store_question("How do 'Pipeline Jungles' contribute to technical debt?",
                    "Pipeline jungles are overly complex data processing pipelines that evolve organically, making it difficult to manage, test, and maintain data flow within ML systems.", $conn);
    store_question("What is 'Abstraction Debt' in ML systems?",
                    "Abstraction debt occurs when systems lack strong and clear abstractions, leading to complex interdependencies and making the system harder to modify and maintain.", $conn);
    store_question("What are 'Common Smells' that indicate technical debt in ML systems?",
                    "Plain-Old-Data Type Smell, Multiple-Language Smell, Prototype Smell",$conn);
    store_question("How does 'Configuration Debt' manifest in ML systems?",
                    "Configuration debt arises from complex and error-prone configuration settings that may outgrow the main codebase and lead to issues when modifying or extending system behavior.",$conn);
    store_question("What are the principles of good configuration management in ML systems?",
                    "Ease of incremental configuration changes, Automated verification of configurations, Clear visualization of configuration differences, Full code review and version control of configurations",$conn);
    store_question("What are the dangers of 'Fixed Thresholds' in dynamic ML systems?",
                    "Manually set thresholds may become outdated as models learn from new data, potentially leading to misclassification or poor performance.",$conn);
    store_question("Why is real-time monitoring essential for ML systems?",
                    "Real-time monitoring helps detect anomalies quickly and enables automated or manual responses to maintain system stability and performance.",$conn);
    store_question("What metrics should be monitored in ML systems?",
                    "Prediction Bias, Action Limits, Upstream Data Quality",$conn);
    store_question("What is 'Data Testing Debt' in ML systems?",
                    "Data testing debt is the gap between rigorous testing applied to code and the often minimal testing of input data quality and consistency.",$conn);
    store_question("Why is reproducibility challenging in ML systems?",
                    "Randomized algorithms, non-deterministic behavior in parallel processing, and changing external data sources make reproducing results difficult.",$conn);
    store_user("mohammad.zeineddine50@gmail.com",hash("sha3-256","123"),"mohammad",$conn);
    store_user("mohammad.ziendeen50@gmail.com",hash("sha3-256","123"),"zeineddine",$conn);

?>