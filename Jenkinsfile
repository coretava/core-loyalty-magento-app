pipeline {
    agent {
        kubernetes {
            yaml '''
            spec:
                containers:
                - name: php
                  image: php:8
                  command:
                    - sleep
                  args:
                    - 99d
            '''
        }
    }
    environment {
        SLACK_CHANNEL = "#core-loyalty-magento-deployments"
    }
    stages {
        stage('Run CI?') {
            steps {
                slackSend message: "[<${BUILD_URL}|Build-${BUILD_NUMBER}>] Start building Core Loyalty Magento extension", color: '#FFFF00', channel: "${SLACK_CHANNEL}"
                script {
                    if (sh(script: "git log -1 --pretty=%B | fgrep -ie '[skip ci]' -e '[ci skip]'", returnStatus: true) == 0) {
                        currentBuild.result = 'NOT_BUILT'
                        error 'Aborting because commit message contains [skip ci]'
                    }
                }
            }
        }
        stage('Prepare') {
            steps {
                container('php') {
                    sh 'apt-get -y update'
                    sh 'apt-get install -y git libicu-dev zlib1g-dev libpng-dev libxslt-dev libzip-dev'
                    sh 'docker-php-ext-configure intl'
                    sh 'docker-php-ext-install intl bcmath gd xsl zip'
                    sh 'curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer'
                    sh 'composer config --auth http-basic.repo.magento.com 9d48a380d9bbc8101cb2e47894cdffcb 8152b462329c2755b9dff42a1ea3f2ab'
                }
            }
        }
        stage('Install') {
            steps {
                container('php') {
                    sh 'composer install'
                }
            }
        }
        stage('Evalute Version') {
            steps {
                container('php') {
                    script {
                        env.CURRENT_COMPOSER_VERSION = sh(
                                script: 'composer config version',
                                returnStdout: true
                        ).trim()
                        env.NEW_COMPOSER_VERSION = sh(
                                script: 'echo ${CURRENT_COMPOSER_VERSION} | awk -F. -v OFS=. \'{$NF += 1 ; print}\'',
                                returnStdout: true
                        ).trim()
                    }
                }
            }
        }
        stage('Set Composer Version') {
            steps {
                container('php') {
                    sh "composer config version ${NEW_COMPOSER_VERSION}"
                }
                withCredentials([gitUsernamePassword(credentialsId: "github-app-coretava-jenkins")]) {
                    sh "git add ."
                    sh "git config --global user.email \"jenkins@coretava.com\""
                    sh "git config --global user.name \"Jenkins CICD\""
                    sh "git commit -m \"[skip ci] tag (${NEW_COMPOSER_VERSION})\""
                    sh "git tag ${NEW_COMPOSER_VERSION}"
                    sh "git push origin HEAD:${BRANCH_NAME}"
                    sh "git push --tags"
                }
            }
        }
    }
    post {
        failure {
            slackSend message: "[<${BUILD_URL}|Build-${BUILD_NUMBER}>] Failed building Core Loyalty Magento extension", color: '#FF0000', channel: "${SLACK_CHANNEL}"
        }
        success {
            slackSend message: "[<${BUILD_URL}|Build-${BUILD_NUMBER}>] Finshed building Core Loyalty Magento extension successfully (${NEW_COMPOSER_VERSION})", color: '#00FF00', channel: "${SLACK_CHANNEL}"
        }
        aborted {
            slackSend message: "[<${BUILD_URL}|Build-${BUILD_NUMBER}>] Building Core Loyalty Magento extension aborted", color: '#909090', channel: "${SLACK_CHANNEL}"
        }
    }
}
